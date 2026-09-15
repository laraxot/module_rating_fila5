---
title: "Design: opzione 'altro' con textarea obbligatoria nel Select dei rating figli"
epic: "5"
slug: rating-altro-option-conditional-textarea-design
status: ready-for-dev
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
entry con chiave `''` o `null`.

Dopo il branch, una coda comune si applica a **qualunque** `$component` (Select o TextInput):

```php
return $component
    ->nullable()
    ->inlineLabel()
    ->rules((string) ($rating->rule->value ?? ''))
    ->afterStateUpdated(
        static function (Set $set, Get $get) use ($caller, $readonlyRatings): void {
            $caller?->recalculateRatingFields($set, $get, $readonlyRatings);
        }
    );
```

`getRatingsFormSchema()` chiama poi `$caller?->decorateRatingField($rating, $component)` **una
volta sola**, sul componente già completo, e lo indicizza con **un solo nome di campo**:
`$schema[self::ratingFieldName($rating)] = ...`.

Il valore scelto va nel pivot `value` (colonna `decimal(10,3)` su `rating_morph`), tramite
`ratingFieldName()`:

```php
public static function ratingFieldName(BaseRating $rating): string
{
    return 'ratings.'.$rating->id.'.pivot.value';
}
```

Nessun parametro per colonne pivot diverse da `value` — verificato leggendo il metodo, non
assunto.

## Campo per il testo libero — già esiste, non serve migration

La tabella `rating_morph` ha già una colonna `note` (`text`, nullable), definita in
`Modules/Rating/database/migrations/2026_07_27_100005_create_rating_morph_table.php` (riga 30)
e nella migration di compatibilità `2026_07_15_120003_create_rating_morph_table.php` (riga 48,
guardia `hasColumn`) — vedi `rating-morph-migrazioni-doppie.story.md`. Nessun nuovo campo DB è
necessario: il testo di "altro" vive in `rating_morph.note`.

## Pattern esistenti nel progetto

`visible(fn (...))` su componenti Filament reattivi (`live()` + `visible()`) è già in uso in
altri moduli (`Incentivi/.../StabiDirigentesTable.php`,
`IndennitaResponsabilita/.../MailTemplateForm.php`). Non è un pattern nuovo da inventare.

`Filament\Schemas\Components\Group` esiste (`vendor/filament/schemas/src/Components/Group.php`,
verificato) ed è compatibile col tipo di ritorno di `buildRatingComponent()`
(`Filament\Schemas\Components\Component`, lo stesso import già in uso nel trait).

## Vincolo del trait — nessuna eccezione, con una precisazione

Il trait **non chiama mai `->label()`** su un componente (vedi commento righe 278-281 del
trait): l'etichetta di un *componente* è un dato che appartiene all'host, non una costante —
regola `no-filament-labels`, decisione D-1 della story 5.92. Questo vincolo riguarda
`Component::label()`, cioè l'etichetta del *campo*.

Il testo dell'opzione **"Altro" dentro l'array `$options` di un Select non è la label di un
componente**: è un valore di dominio Rating, allo stesso livello del nome colonna `note` o
della convenzione `ratings.*.pivot.value` — un dato che il modulo Rating possiede, non un
dato specifico dell'host che consuma il trait. Per questo la Decisione 3 (sotto) fa produrre
al trait stesso `trans('rating::fields.altro')`, senza violare D-1: non è un `->label()` su un
componente, è un valore di un array di opzioni, di proprietà del modulo Rating.

## Decisioni prese

### 1. Chiave sentinella per "altro"

**Decisione**: costante privata sul trait, non su `BaseRating`.

```php
private const string ALTRO_KEY = 'altro';
```

**Perché sul trait e non su `BaseRating`**: nessun consumer esterno al trait deve confrontare
questa chiave (vedi Decisione 3 — non serve un nuovo metodo sul contratto, quindi l'host non
ha mai bisogno di leggerla). Se in futuro un host reale avesse bisogno di distinguere "altro"
dalle altre risposte (es. in `recalculateRatingFields()`), si promuove a costante pubblica
allora, guidati da quel requisito — non ora (YAGNI).

**Perché una stringa esplicita e non `''`/`null`**: le chiavi esistenti sono id interi
autoincrement; `''`/`null` sono ambigui con lo stato iniziale "nessuna scelta fatta" del
Select (che Filament rappresenta internamente come stato vuoto). Una stringa `'altro'`
comparabile con `===` non collide mai con un id (tipi diversi dopo cast, valore distinguibile
da "non ancora risposto").

### 2. Dove salvare il testo libero

**Decisione**: `rating_morph.note` (già esiste, nessuna migration). Nome campo form:

```php
public static function ratingFieldName(BaseRating $rating, string $pivotColumn = 'value'): string
{
    return 'ratings.'.$rating->id.'.pivot.'.$pivotColumn;
}
```

Modifica **retrocompatibile** (parametro con default): ogni chiamata esistente
`ratingFieldName($rating)` continua a restituire `...pivot.value` invariato. La nuova chiamata
per la nota è `ratingFieldName($rating, 'note')` → `ratings.{id}.pivot.note`.

### 3. Label dell'opzione "altro" — il trait la produce, non `->label()` su un componente

**Decisione**: `trans('rating::fields.altro')`, chiamato dal trait dentro `buildRatingComponent()`,
per popolare il *valore* dell'opzione nell'array `$options` (non per impostare `->label()` su
nessun componente). Vedi motivazione sopra ("Vincolo del trait — con una precisazione").

Se la chiave di traduzione manca, `trans()` restituisce la chiave stessa
(`'rating::fields.altro'`) — degradazione visibile ma non un crash, coerente con "senza
`$caller` lo schema è comunque valido" già documentato nel trait per `decorateRatingField()`.

**Nessun nuovo metodo su `RatingsFormCallerContract`.** Verificato leggendo il contratto
(`decorateRatingField(BaseRating $rating, Component $component): Component`, riga 44): riceve
il componente **già costruito** (nel nuovo design, il `Group` che contiene Select + Textarea),
non l'array `$options` grezzo prima della build. Un ipotetico `decorateRatingOptions()`
arriverebbe troppo tardi nel flusso per essere utile senza restrutturare quando viene
invocato — un nuovo metodo di contratto per un valore che il modulo Rating già possiede
(come `note`) sarebbe complessità aggiunta senza bisogno reale (YAGNI).

### 4. Validazione condizionale

**Decisione**:

```php
Textarea::make(self::ratingFieldName($rating, 'note'))
    ->visible(static fn (Get $get): bool => $get(self::ratingFieldName($rating)) === self::ALTRO_KEY)
    ->required(static fn (Get $get): bool => $get(self::ratingFieldName($rating)) === self::ALTRO_KEY);
```

Nessun `->maxLength()`: `note` è `text` nullable, nessun vincolo di lunghezza esiste oggi nel
dominio. Se un caso reale lo richiede, si aggiunge con story separata guidata da quel
requisito (YAGNI — non anticipare vincoli non richiesti).

### 5. `recalculateRatingFields()` e la nota

**Decisione**: non reagisce al cambio di `note`. Il hook esiste per ricalcoli che dipendono
dal **valore numerico** (`pivot.value`) dei rating readonly; `note` è puro storage descrittivo,
non aziona business logic. Resta agganciato solo al campo Select/TextInput principale, come
oggi.

### 6. Opt-in per singolo rating

**Decisione**: nessun flag. Quando un rating ha figli, l'opzione "altro" è **sempre**
disponibile — stesso principio KISS con cui oggi tutti i rating con figli ricevono
automaticamente un Select. Se un caso reale richiede di escluderla per un rating specifico, si
aggiunge un flag esplicito guidato da quel requisito, non ora.

## Pseudocodice completo (NON implementazione)

Punto critico verificato: la coda comune (`nullable/inlineLabel/rules/afterStateUpdated`) oggi
si applica a **qualunque** `$component` restituito dal branch (Select o TextInput), perché è
uno solo. Con il nuovo design, quella coda deve restare sul **Select**, non sul `Group` che lo
avvolge insieme alla Textarea — un `Group` non ha `.rules()`/`nullable()` con lo stesso
significato di un campo. Questo richiede spostare la coda **dentro** il branch "con figli",
applicata al Select prima di comporre il Group, mantenendo la coda invariata per gli altri due
branch.

```php
private function buildRatingComponent(
    BaseRating $rating,
    ?RatingsFormCallerContract $caller,
    Collection $readonlyRatings,
): Component {
    $field = self::ratingFieldName($rating);

    if ($rating->is_readonly === true) {
        return TextEntry::make($field)->inlineLabel();
    }

    $options = $rating->children
        ->mapWithKeys(static fn (BaseRating $child): array => [$child->id => $child->getLabel()])
        ->all();

    $afterStateUpdated = static function (Set $set, Get $get) use ($caller, $readonlyRatings): void {
        $caller?->recalculateRatingFields($set, $get, $readonlyRatings);
    };

    if ($options === []) {
        return TextInput::make($field)
            ->numeric()
            ->live(onBlur: true)
            ->nullable()
            ->inlineLabel()
            ->rules((string) ($rating->rule->value ?? ''))
            ->afterStateUpdated($afterStateUpdated);
    }

    $options[self::ALTRO_KEY] = trans('rating::fields.altro');

    $select = Select::make($field)
        ->options($options)
        ->live()
        ->nullable()
        ->inlineLabel()
        ->rules((string) ($rating->rule->value ?? ''))
        ->afterStateUpdated($afterStateUpdated);

    $note = Textarea::make(self::ratingFieldName($rating, 'note'))
        ->visible(static fn (Get $get): bool => $get($field) === self::ALTRO_KEY)
        ->required(static fn (Get $get): bool => $get($field) === self::ALTRO_KEY);

    return Group::make([$select, $note]);
}
```

**Nota su `getRatingsFormSchema()`**: nessuna modifica necessaria. Continua a indicizzare
`$schema[self::ratingFieldName($rating)] = $caller?->decorateRatingField($rating, $component) ?? $component`
— `$component` ora può essere un `Group`, e `decorateRatingField()` lo riceve intero (il
contratto non cambia firma).

**Import nuovi richiesti**: `Filament\Forms\Components\Textarea`,
`Filament\Schemas\Components\Group` (verificati esistenti, non assunti).

## Criteri di accettazione (per l'implementazione)

- [ ] `ALTRO_KEY` = costante privata `'altro'` su `HasRatingsTrait`
- [ ] `ratingFieldName()` esteso con parametro `string $pivotColumn = 'value'`, retrocompatibile
- [ ] `trans('rating::fields.altro')` — chiave aggiunta a `Modules/Rating/lang/it/fields.php`
      (e alle altre lingue presenti nel modulo, stesso pattern delle chiavi esistenti)
- [ ] Coda `nullable/inlineLabel/rules/afterStateUpdated` applicata al `Select`, non al `Group`
- [ ] `Textarea` su `ratings.{id}.pivot.note`, `visible()` e `required()` sullo stesso confronto
      `=== ALTRO_KEY`, nessun `->maxLength()`
- [ ] Nessuna modifica a `RatingsFormCallerContract` (nessun nuovo metodo)
- [ ] Nessuna migration (confermato: colonna `note` già esistente)
- [ ] Test Pest scritti PRIMA (TDD, standing order): opzione "altro" presente nelle options,
      textarea nascosta di default, visibile dopo selezione "altro" (via `live()`), required
      solo quando visibile, valore salvato su `pivot.note`, altri rating (readonly, senza
      figli) invariati
- [ ] PHPStan livello 10, PHPMD, PHPInsights, Pest coverage — come da standing order

## Riferimenti

- `Modules/Rating/app/Models/Traits/HasRatingsTrait.php:260-263` (`ratingFieldName`)
- `Modules/Rating/app/Models/Traits/HasRatingsTrait.php:343-373` (`buildRatingComponent`)
- `Modules/Rating/app/Contracts/RatingsFormCallerContract.php:44` (`decorateRatingField`)
- `Modules/Rating/database/migrations/2026_07_27_100005_create_rating_morph_table.php:30`
  (colonna `note`)
- `vendor/filament/schemas/src/Components/Group.php` (esistenza verificata)
- Story 5.92: `get-ratings-form-schema-nel-trait.story.md` (decisione D-1, no-filament-labels)
- `rating-morph-migrazioni-doppie.story.md` (doppia migration rating_morph)
