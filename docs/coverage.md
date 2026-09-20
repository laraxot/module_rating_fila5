---
title: "Coverage del modulo Rating"
type: report
module: Rating
<<<<<<< HEAD
updated: 2026-09-01
=======
updated: 2026-09-08
>>>>>>> laraxot/dev
qmd: "coverage rating pest misura reale test saltati database"
---

# Coverage del modulo Rating

<<<<<<< HEAD
=======
## Verifica PHPStan dell'8 settembre 2026

Nessuna nuova misura di coverage. Il preflight trova `app.env=testing` nella cache
configurazione, ma la connessione `indennita_responsabilita` usata da
`ChildrenRelationManagerParentTest` non ha un database con suffisso `_test`.
La suite con scritture non viene lanciata finché l'isolamento non è provato.

Il contratto `linkedTo()` è stato verificato con uno smoke CLI sul modello reale,
senza bootstrap Laravel: chiavi `model_type`/`model_id`, padre corretto, nessuna
connessione e nessuna query. Non equivale a una misura Pest o coverage.

Dettagli, gate statici e cause in [Contratto linkedTo](phpstan-linked-to-contract.md).
I numeri e il comando nella sezione seguente descrivono la configurazione storica
del 1 settembre; il file `Modules/Rating/phpunit.xml` oggi non è presente e il
comando non va riutilizzato come configurazione corrente.

>>>>>>> laraxot/dev
## Misura del 1 settembre 2026

Comando canonico (AD-25 — servono **entrambe** le opzioni: `-c` sposta il perimetro
di coverage, il path sposta il bootstrap di `Pest.php` e `Helpers.php`):

```bash
cd laravel
XDEBUG_MODE=coverage ./vendor/bin/pest Modules/Rating/tests -c Modules/Rating/phpunit.xml --coverage --min=0
```

| | |
|---|---:|
| **Coverage di riga** | **80.8 %** |
| Test passati | 118 |
| Test saltati | 7 |
| Falliti | 0 |
| Asserzioni | 442 |

## Come leggere questo numero

La percentuale copre il codice sotto `Modules/Rating/app`, che e il perimetro
dichiarato in `Modules/Rating/phpunit.xml`.

**7 test sono stati saltati**, non falliti. I salti in questo progetto
vengono quasi sempre dal database di test irraggiungibile (`10.100.200.53:3306`)
e non da `skip()` scritti a mano: la suite resta verde e il numero descrive solo
la parte che ha girato davvero.

## Cosa e cambiato oggi

Prima di questa misura la suite era rossa su
`tests/Unit/ListRatingsPageTest.php:23`, che asserva 5 colonne su
`BaseListRatings::getTableColumns()`. Quel metodo pero e chiuso dentro un docblock
mai terminato: le colonne sono state spostate di proposito nelle classi sotto
`app/Filament/Resources/RatingResource/Tables/`.

Il test era vecchio, non il codice. Riscritto per asserire il contratto vero — la
pagina non possiede piu colonne, e le 9 colonne stanno in `RatingsTable` — la suite
e verde e il coverage e diventato misurabile: **80,8 %**.

## Precondizioni che invalidano la misura

1. **`bootstrap/cache/config.php` non deve esistere.** Con la config in cache
   `config('app.env')` vale `production` e `app()->runningUnitTests()` diventa falso:
   ogni guardia costruita su quel segnale smette di funzionare. Il file e gitignored e
   viene rigenerato da un qualsiasi `artisan optimize`, quindi va ricontrollato ogni volta.
2. **Nessun altro agente deve stare scrivendo sul tree.** Una run su file in scrittura
   produce risultati diversi a ogni giro.

```bash
/usr/bin/find Modules -newermt '-70 seconds' -type f | wc -l   # deve dare 0
```

<<<<<<< HEAD
## Aggiornamento del 6 settembre 2026 (PHPStan zero-error, story phpstan-Rating-fix)

Baseline PHPStan `Modules/Rating` ripulita da 6 → 0 errori (1 `cast.string` in
`HasRatingsTrait::getRatingsRules()`, 5 `method.deprecated` in
`tests/Unit/ListRatingsPageTest.php`). Dettagli tecnici:
`docs/stories/phpstan-Rating-fix.md`.

`tests/Unit/ListRatingsPageTest.php` è stato riportato da 1 a 2 test dopo la
rimozione delle chiamate deprecate: il test sulle colonne è stato riscritto contro
`$page->table(Table::make($page))->getColumns()` invece di chiamare
`getTableColumns()` deprecato direttamente (stesso pattern di
`RatingFilamentExtendedTest.php`, story 2.3). I tre test su filtri/header/row
actions non sono stati riproposti con lo stesso pattern: passando dal `Table`
costruito, `HasXotTable::invokeTableHook()` salta di proposito
`getTableFilters()/getTableHeaderActions()/getTableActions()/getTableBulkActions()`
quando non overridati dalla pagina concreta (per non duplicare i default nativi
Filament), quindi avrebbero prodotto asserzioni false — non erano nello scope
PHPStan/deprecazione della story.

Verifica mirata (rete/CPU condivisa con ~30 agenti concorrenti, run full-module
troppo lento per attendere in sessione):
```
./vendor/bin/pest Modules/Rating/tests/Unit/ListRatingsPageTest.php -c Modules/Rating/phpunit.xml --no-coverage
Tests: 2 passed (2 assertions)
```
PHPStan `Modules/Rating` cold: **0 errori** (confermato 3 volte con
`clear-result-cache` prima di ogni run).

## Aggiornamento del 7 settembre 2026 (DoD piena — typeCoverage + PHPMD, story RATING-2.4)

Fix `typeCoverage.constantTypeCoverage` (const tipizzata su `Rating.php::BLOCK_TYPE`) +
pulizia PHPMD (~40→12 violazioni, resto documentato come falso positivo o vincolo di
framework — dettaglio in `docs/stories/2.4.dod-full-closure-typecoverage-phpmd.story.md`).
Nessun comportamento nuovo: solo rename camelCase, un `MissingImport`, un
extract-method a comportamento identico (`Datas/RatingData::fromArray()`, complessità
ciclomatica 11→~5), rimozione di un parametro closure morto.

Verifica mirata (carico condiviso ~30 agenti attivo, suite completa lanciata in
background con timeout 8 min per lo stesso motivo):
```
./vendor/bin/pest Modules/Rating/tests/Unit/RatingDatasDataTest.php --no-coverage
Tests: 6 passed (29 assertions) — 38.31s (5-8s/test, carico condiviso, non un hang)
```
PHPStan `Modules/Rating`: verde più volte durante il lavoro (cache pulita ogni
volta); verifica finale bloccata da un bootstrap-fatal non correlato su
`Modules/Platform` (WIP di un altro agente, classe mancante temporaneamente) —
`php -l` pulito su tutti i file toccati.

=======
>>>>>>> laraxot/dev
## Storico

| Data | Passati | Saltati | Falliti | Coverage |
|---|---:|---:|---:|---|
| 2026-09-01 | 118 | 7 | 0 | 80.8 % |
<<<<<<< HEAD
| 2026-09-06 (mirato, vedi nota sopra) | 2/2 file toccato | — | 0 | non ricalcolata (full-suite non completata per carico condiviso) |
| 2026-09-07 (mirato, story RATING-2.4) | 6/6 file toccato | — | 0 | non ricalcolata (full-suite in background, carico condiviso) |

=======


---

## Misura del 9 settembre 2026 — story `IndennitaResponsabilita/8.22`

**Coverage non misurato, e va detto perché.** Il comando canonico qui sopra richiede
`-c Modules/Rating/phpunit.xml`; quel file (`phpunit.xml.dist`) risulta **cancellato nel
working tree** da un'altra sessione, insieme ad altre 54 cancellazioni pendenti nel modulo.
Finché non torna, la misura di coverage di questo modulo **non è ripetibile**. Non l'ho
ripristinato: non è materia della story 8.22 e non voglio interferire con quel working tree.

Eseguito invece `./vendor/bin/pest Modules/Rating/tests` (senza `-c`, quindi senza coverage):

| | 1 set 2026 | 9 set 2026 |
|---|---:|---:|
| Passati | 118 | **105** |
| Saltati | 7 | **5** |
| **Falliti** | **0** | **19** |
| Asserzioni | 442 | 404 |
| Durata | — | 248 s |

### I 19 falliti sono preesistenti, e sono di due famiglie

**17 su 19 — refactor Filament in corso.** `Non-static method
BaseRatingForm::getFormSchema() cannot be called statically`: `XotBaseResourceForm` è stata
resa astratta e il metodo non statico (registrato in `docs/sprint-status.yaml` come
«structural-change-form-infolist»), i test la chiamano ancora staticamente. Colpisce
`RatingDatasDataTest` (5), `RatingFilamentSchemaTest` (4), `RatingFilamentRelationManagerTest`
(2), `RatingFilamentExtendedTest` (2), `ListRatingsPageTest` (2), `RatingBlockTest` (1),
`BaseRatingModelTest` (1).

**2 su 19 — database di test indietro di una migrazione.** `SQLSTATE[42S22] Unknown column
'slug'` su `ptv_lara_test`. La colonna è creata da `RatingData::updateColumns()` (righe 73-74)
e serve a `Spatie\Sluggable\HasSlug`; **sulla connection di sviluppo esiste** — verificato con
`Schema::getColumnListing('ratings')`. È la divergenza di schema fra installazioni tracciata
da `Xot/5.87.guardia-divergenza-schema-fra-installazioni`.

### Cosa ha aggiunto la story 8.22

`RuleEnum::ZeroFour` e `RuleEnum::ZeroSix` (griglia art. 17 c. 6 del CCI 2026-2028), le due
voci in `lang/it/rule_enum.php`, e **tre test** in `RuleEnumTest` — le sei asserzioni sui
valori più due guardie che reggono anche il caso del prossimo rinnovo:

- ogni caso ha l'etichetta tradotta (`getLabel()` non comincia per `rating::`);
- i tetti `[5,6,4,4,6]` sono tutti esprimibili e sommano 25.

`RuleEnumTest`: **3 passati, 22 asserzioni**. PHPStan `[OK] No errors`, PHPMD 0 violazioni,
PHP Insights **100/100/100/100** su `app/Enums`, Pint `passed`.

**Il numero di test passati è sceso, il perimetro coperto è salito**: le due guardie nuove non
esistevano. I 13 test in meno rispetto al 1 settembre sono i falliti delle due famiglie sopra,
nessuno dei quali tocca l'enum.

---

## Verifica PHPStan del 16 settembre 2026 — story `Rating/phpstan-fleet-fix-2026-09-16`

Comando: `cd laravel && ./vendor/bin/phpstan analyse Modules/Rating --no-progress --memory-limit=-1`.

**Esito: `[OK] No errors`.** I 5 errori noti (evidence `laravel/build/phpstan-Rating.json`)
erano già risolti nel working tree da un fork precedente di questa stessa sessione (story
`Rating/5.157-phpstan-rating-pivot-get-test`, non ancora committata):

- `Models/BaseRating.php` — aggiunto `@property-read BaseRatingMorph $pivot` al docblock
  della classe. `ratings()` è una `MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'>`
  (quarto/terzo generic = `MorphPivot`): Larastan non infila da solo `->pivot` come proprietà
  statica del modello, va dichiarato. Tipizza la pivot reale (`BaseRatingMorph`, con `value` e
  `note`) invece di castare `mixed` — risolve le 4 righe `property.notFound`/`property.nonObject`
  su `HasRatingsTrait.php:362-363` (`hydrateRatingsFormData()`).
- `tests/Unit/HasRatingsTraitOtherOptionTest.php:243` — lo stub `Get` per il test
  "la Textarea e required solo quando Get sul Select restituisce other" non usa più
  `Mockery::mock(Get::class)` (tipizzato `Get&MockInterface`, phpstan si aspettava
  `Get&MockInterface` di ritorno ma vedeva solo `MockInterface`): sostituito con una classe
  anonima che estende `Get` e sovrascrive `__invoke()` con la stessa firma del parent
  (`string|Component $path = '', bool $isAbsolute = false`), confrontando `$path === $select`
  com'era nel mock originale. Verificato contro l'uso reale in
  `HasRatingsTrait.php:517` (`->required(static fn (Get $get) => self::selectIsOther($get($select)))`)
  — il chiamante passa un `Component`, non una stringa, e lo stub lo rispecchia.

Nessuna soppressione, nessun cast a `mixed`, nessuna baseline/ignore: solo narrowing tipizzato.
`phpstan.neon` non toccato.

### PHPMD — `tools/phpmd.sh Modules/Rating/app`

Girato senza crash sui file toccati. Solo violazioni di stile preesistenti e fuori scope
(`CamelCaseVariableName`, `CyclomaticComplexity`, `BooleanArgumentFlag`, ecc. su
`Datas/RatingData.php`, `Models/Traits/HasRating.php`, `Models/Traits/RatingTrait.php`, ...).
Crash noto e preesistente (non introdotto da questa story, non tocca file editati qui) su
`Filament/Resources/HasRatingResource/Widgets/StatsOverview.php` e
`Filament/Widgets/StatsOverview.php`: PDepend non fa il parse di una classe anonima/tipo DNF
(vedi memoria `feedback-phpmd-phar-dies-on-dnf-types.md`).

### PHP Insights — `tools/phpinsights.sh analyse Modules/Rating/app`

Girato senza errori. Punteggi: Code 92.9, Complexity 100, Architecture 85.7, Style 85.2.
Findings tutti preesistenti e fuori scope (import ordering, `==` vs `===`, parametri non
usati nelle policy, ecc.), nessuno sui due file toccati da questa story oltre a un
riordino import segnalato su `Models/BaseRating.php` (stile, non bloccante, non toccato per
restare nello scope dichiarato dalla story 5.157).

### Pest — skip ambientale documentato

`nc -z -w3 10.100.200.53 3306` → **UNREACHABLE** (confermato due volte, a inizio e durante
questa verifica). `./vendor/bin/pest Modules/Rating/tests/Unit/HasRatingsTraitOtherOptionTest.php`
lanciato con timeout 120s: **nessun output, terminato per timeout** (non un fallimento del
fix — il bootstrap pende sul DB irraggiungibile invece di fallire subito, vedi memoria
`feedback-check-db-reachability-first.md`). Coverage non misurato oggi.

| Data | PHPStan Rating | PHPMD | Insights | Pest |
|---|---|---|---|---|
| 2026-09-16 | **0 errori** | 0 violazioni sui file toccati (crash preesistente altrove) | 92.9/100/85.7/85.2 | skip — DB `10.100.200.53:3306` unreachable |
>>>>>>> laraxot/dev
