---
title: "Design: opzione 'altro' con textarea obbligatoria nel Select dei rating figli"
epic: "5"
slug: rating-altro-option-conditional-textarea-design
status: brainstorming
module: Rating
created: 2026-09-15
updated: 2026-09-15
related: []
github_issues:
  - laraxot/module_rating_fila5#57
---

## Contesto — come funziona oggi

`HasRatingsTrait::buildRatingComponent()` (`Modules/Rating/app/Models/Traits/HasRatingsTrait.php:343-373`)
decide fra tre rese per una riga di `ratings`:

1. `is_readonly === true` → `TextEntry` (sola lettura)
2. Riga con figli (`$rating->children` non vuota) → `Select::make($field)->options($options)->live()`
3. Riga senza figli → `TextInput::make($field)->numeric()->live(onBlur: true)`

Le opzioni del `Select` sono **esclusivamente** i figli esistenti:

```php
$options = $rating->children
    ->mapWithKeys(static fn (BaseRating $child): array => [$child->id => $child->getLabel()])
    ->all();
```

Le chiavi sono **id interi** dei rating figli (autoincrement DB) — non esiste oggi nessuna
entry con chiave `''` o `null`. Un'opzione "altro" andrebbe **aggiunta esplicitamente**
all'array `$options`, non dedotta da uno stato già presente.

Il valore scelto va nel pivot `value` (colonna `decimal(10,3)` su `rating_morph`), tramite
`ratingFieldName()`: `'ratings.'.$rating->id.'.pivot.value'`.

## Campo per il testo libero — già esiste, non serve migration

La tabella `rating_morph` ha già una colonna `note` (`text`, nullable), definita in
`Modules/Rating/database/migrations/2026_07_27_100005_create_rating_morph_table.php` e
`2026_07_15_120003_create_rating_morph_table.php` (doppia migrazione, vedi
`rating-morph-migrazioni-doppie.story.md`). Nessun nuovo campo DB è necessario: il testo di
"altro" può vivere in `rating_morph.note`, seguendo la stessa convenzione di
`ratingFieldName()` → `'ratings.'.$rating->id.'.pivot.note'`.

## Pattern esistenti nel progetto

`visible(fn (...))` su componenti Filament reattivi (`live()` + `visible()`) è già in uso in
altri moduli (`Incentivi/.../StabiDirigentesTable.php`,
`IndennitaResponsabilita/.../MailTemplateForm.php`). Non è un pattern nuovo da inventare.

Il trait ha già un hook reattivo generico: `afterStateUpdated()` chiama
`$caller?->recalculateRatingFields($set, $get, $readonlyRatings)` — punto di aggancio
naturale per eventuale logica di dominio legata alla scelta "altro", senza che il trait
debba saperne il significato (coerente con `RatingsFormCallerContract`).

## Vincolo del trait — nessuna eccezione

Il trait **non chiama mai `->label()`** (vedi commento righe 278-281 del trait): l'etichetta
è un dato (`txt`/`title`), non una costante — regola `no-filament-labels`, decisione D-1
della story 5.92. Qualunque campo nuovo (Select con opzione "altro", Textarea condizionale)
deve rispettare lo stesso vincolo: nessuna label hardcoded nel trait, il particolare resta
all'host via `RatingsFormCallerContract::decorateRatingField()`.

## Design — opzioni da decidere (non implementate)

### 1. Come identificare "altro" nel Select

Non esiste un valore naturale `''`/`null` tra i figli (le chiavi sono id interi). Tre vie:

- **A** — chiave sentinella stringa esplicita, es. `'altro' => 'Altro'` aggiunta a `$options`
  dopo il mapping dei figli. Comparabile con `===`, non ambigua con un id.
  Rischio: se un giorno un id numerico collide lessicalmente con `'altro'` non è un
  problema (tipi diversi), ma la constant "altro" andrebbe centralizzata (vedi §4).
- **B** — chiave `''` (stringa vuota), coerente con l'ipotesi originale della richiesta.
  Rischio: più ambigua da leggere in un `match`/`if`, e `nullable()` è già chiamato sul
  componente (riga 365) — va verificato che `''` non collassi a `null` nel salvataggio Livewire/Filament prima di scegliere questa via.
- **C** — chiave `null`. Stesso rischio di B più l'ambiguità con "nessuna scelta fatta"
  (stato iniziale del Select). Sconsigliata: renderebbe indistinguibile "non ho ancora
  risposto" da "ho risposto altro".

**Raccomandazione preliminare**: opzione A (chiave stringa esplicita `'altro'|'other'`), per
evitare la collisione semantica con "non ancora risposto" (B/C). Da confermare con chi
possiede il dominio (stesso principio della nota su `model_type` nel trait: la decisione va
a chi possiede i dati, non al meccanismo generico).

### 2. Dove salvare il testo

`rating_morph.note` (già esiste, vedi sopra). Nome campo form coerente con la convenzione:
`'ratings.'.$rating->id.'.pivot.note'`.

### 3. Validazione condizionale

`Textarea::make(...)->required(fn (Get $get) => $get($selectField) === 'altro')`, usando lo
stesso `Get $get` già iniettato in `afterStateUpdated()`. La regola di validazione del
`Select` (`$rating->rule->value`) resta quella già presente sulla riga — la nuova regola è
aggiuntiva e vive solo sulla `Textarea`, non sostituisce quella esistente.

### 4. Dove vive la chiave sentinella "altro"

Se opzione A: la stringa `'altro'` (o `'other'`) va definita in **un posto solo** — coerente
con lo spirito di `ratingFieldName()` (convenzione unica, cambia in un posto solo). Candidato:
costante pubblica sul trait o su `BaseRating`, non una stringa ripetuta a mano nei punti che
la confrontano.

### 5. Retrocompatibilità

Nessun dato esistente usa oggi la chiave "altro" (non esiste nel meccanismo attuale): zero
righe da migrare. Il campo `note` è già nullable e già esistente — nessuna migration
additiva richiesta per questo design.

## Pseudocodice illustrativo (NON implementazione)

```php
// Dentro buildRatingComponent(), ramo "riga con figli":
$options = $rating->children
    ->mapWithKeys(static fn (BaseRating $child): array => [$child->id => $child->getLabel()])
    ->all();
$options[self::ALTRO_KEY] = /* label da dato, non hardcoded — vedi vincolo no-filament-labels */;

$select = Select::make($field)->options($options)->live();

$noteField = TextEntry-like-o-Textarea::make(self::ratingFieldName($rating) /* variante ->pivot.note */)
    ->visible(fn (Get $get) => $get($field) === self::ALTRO_KEY)
    ->required(fn (Get $get) => $get($field) === self::ALTRO_KEY);
```

## Domande aperte (brainstorming)

- [ ] Chiave sentinella: `'altro'`/`'other'` (stringa esplicita) o si insiste su `''`/`null`?
      Chi decide: chi possiede il dominio Rating (stesso principio di `model_type`).
- [ ] Char limit sulla Textarea? Nessun vincolo trovato oggi su `note` (text, illimitato lato DB).
- [ ] La label dell'opzione "altro" (es. "Altro" / "Other") — da dato tradotto o da dove,
      restando coerenti col vincolo "il trait non chiama mai `->label()`"?
- [ ] `recalculateRatingFields()` deve reagire anche al cambio di `note`, o solo al cambio
      di `value`? (oggi il hook è agganciato solo al campo principale via `afterStateUpdated`)
- [ ] Un rating con figli MA senza opzione "altro" abilitata: serve un flag per
      renderla opt-in per singolo rating, o è sempre presente quando ci sono figli?

## Criteri di accettazione (per una futura story ready-for-dev)

- [ ] Decisione presa su tutte le domande aperte sopra
- [ ] Nessuna migration necessaria (confermato: `note` esiste già)
- [ ] Design rispetta il vincolo "trait non chiama mai `->label()`"
- [ ] Story di implementazione crea test Pest PRIMA (TDD), come da standing order

## Riferimenti

- `Modules/Rating/app/Models/Traits/HasRatingsTrait.php:343-373` (buildRatingComponent)
- `Modules/Rating/app/Contracts/RatingsFormCallerContract.php`
- `Modules/Rating/database/migrations/2026_07_27_100005_create_rating_morph_table.php` (colonna `note`)
- Story 5.92: `get-ratings-form-schema-nel-trait.story.md` (decisione D-1, no-filament-labels)
- `rating-morph-migrazioni-doppie.story.md` (doppia migration rating_morph)
