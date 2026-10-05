---
title: "Rating — Architettura BMAD"
type: note
module: Rating
tags:
  - bmad
  - rating
  - architettura
  - indice
created: 2026-09-28
updated: 2026-09-28
qmd: "rating architettura modelli trait pivot morph export xls"
related:
  - README.md
  - module-boundary.md
  - rating-select-altro-note.md
  - ../brainstorming.md
  - ../epics/rating-export-ssot.md
---

# Rating — Architettura (indice)

> **SUMMARY** — Indice degli shard di architettura del modulo `Rating` piu la mappa
> sintetica verificata. Il dettaglio delle decisioni vive negli shard; questo file non li duplica.

## Shard

| Shard | Path | Contenuto |
|-------|------|-----------|
| Confini di modulo | [architecture/module-boundary.md](architecture/module-boundary.md) | perimetro del dominio Rating |
| Nota obbligatoria «altro» | [architecture/rating-select-altro-note.md](architecture/rating-select-altro-note.md) | contratto del campo nota |
| Spec implementazione «altro» | [architecture/rating-select-altro-implementation-spec.md](architecture/rating-select-altro-implementation-spec.md) | codice previsto per select + textarea |
| Metodi export | [architecture/rating-data-export-methods.md](architecture/rating-data-export-methods.md) | `RatingData` come SSoT export |
| Caller di `getXlsFields()` | [architecture/ratingdata-getxlsfields-caller-resolve.md](architecture/ratingdata-getxlsfields-caller-resolve.md) | come si risolve il chiamante |
| Helper sull'entita | [architecture/rating-entity-helpers-home-in-ratingdata.md](architecture/rating-entity-helpers-home-in-ratingdata.md) | dove vivono gli helper |
| Campi export riusabili | [architecture/rating-export-fields-reusable.md](architecture/rating-export-fields-reusable.md) | riusabilita campi export |
| Campi XLS riusabili | [architecture/rating-xls-fields-reusable.md](architecture/rating-xls-fields-reusable.md) | riusabilita campi XLS |
| Componente tabella | [architecture/rating-table-component.md](architecture/rating-table-component.md) | tabella rating |
| Label form e path XLS | [architecture/form-field-label-and-xls-path-home.md](architecture/form-field-label-and-xls-path-home.md) | label e path XLS |

## Mappa sintetica

| File | Responsabilita |
|------|----------------|
| `app/Models/BaseRating.php` | modello astratto del criterio: `HasMedia`, `RatingContract`, `Sortable`, `HasSlug`, `HasRecursiveRelationships`; `getLabel()`, `linkedTo()`, `getTxtHtml()`, `getValueHtml()`, `getNoteHtml()`, `resolveSelectedChild()`, `getXlsExportValueAttribute()`, `hasChildRatings()` |
| `app/Models/Rating.php` | concreta del catalogo rating, con `SchemalessAttributes` su `extra_attributes` e cast `RuleEnum` |
| `app/Models/BaseRatingMorph.php` | pivot astratto: `rating()`, `user()`, `profile()`, `model()` (morphTo) |
| `app/Models/RatingMorph.php` | concreta del pivot host↔rating |
| `app/Models/BaseMorphPivot.php`, `app/Models/BaseModel.php` | basi pivot e modello |
| `app/Models/AbstractRatingsHost.php` | base degli host che ricevono rating |
| `app/Models/Traits/HasRatingsTrait.php` | relazioni e form: `ratingMorphs()`, `ratings()`, `ratingObjectives()`, `myRatings()`, `ratingFormFields()`, `getRatingsFormSchema()`, `hydrateRatingsFormData()`, `syncRatingsFormData()`, `clearRatingsFormData()`, `getRatingsRules()`, `getRatingsValidationAttributes()`, costante `OTHER_OPTION_KEY = 'other'` |
| `app/Models/Traits/HasRating.php`, `HasLikes.php` | trait host e like |
| `app/Models/Contracts/RatingContract.php` | contratto del criterio (`@phpstan-require-extends Model`, estende `HasRecursiveRelationshipsContract`) |
| `app/Models/Contracts/HasRatingContract.php` | contratto del lato host |
| `app/Contracts/RatingsFormCallerContract.php` | contratto della Page che ospita il form |
| `app/Contracts/HasLikeContract.php` | contratto like |
| `app/Datas/RatingData.php` | SSoT statico: `ratingValuePath()`, `ratingXlsValuePath()`, `ratingFieldName()`, `formFieldLabel()`, `getXlsFields()`, `criteriaToXlsFields()`, `updateColumns()` |
| `app/DataObjects/RatingData.php` | data object del rating |
| `app/Datas/RatingMorphData.php`, `RatingBlockData.php` | data object di pivot e blocco dashboard |
| `app/Enums/RuleEnum.php`, `app/Enums/SupportedLocale.php` | regole di validazione e locale supportato |
| `app/Actions/HasRating/GetRatingOptsByModelAction.php` | opzioni rating per un host |
| `app/Actions/HasRating/GetCountByModelRatingIdAction.php` | conteggio per host + rating |
| `app/Actions/HasRating/GetSumByModelRatingIdAction.php` | somma per host + rating |
| `app/Filament/Resources/RatingResource.php` | catalogo rating (pagine in `Pages/`, `Schemas/`, `Tables/`, `RelationManagers/`) |
| `app/Filament/Resources/RatingMorphResource.php` | pivot rating-host |
| `app/Filament/Resources/HasRatingResource/` | directory senza classe Resource: contiene `RelationManagers/RatingsRelationManager.php` e `Widgets/StatsOverview.php` |
| `app/Filament/Forms/Components/RatingsSection.php` | `XotBaseSection` con `add()` e `getSchema()` |
| `app/Filament/Concerns/DecoratesRatingFormFields.php` | `applyDefaultRatingFieldDecoration()` |
| `app/Filament/Tables/Columns/RatingsColumn.php` | colonna rating |
| `app/Filament/Tables/Filters/HasRatingValuesFilter.php` | filtro sui valori rating |
| `app/Filament/Blocks/Rating.php`, `app/Filament/Pages/Dashboard.php`, `app/Filament/Widgets/StatsOverview.php` | dashboard |

## Dipendenze esterne

Import reali rilevanti:

- `Modules\Xot\Actions\Cast\SafeStringCastAction` in `app/Models/Traits/HasRatingsTrait.php`
- `Modules\Xot\Contracts\ProfileContract` in `app/Models/BaseRating.php` e `BaseRatingMorph.php`
- `Modules\Xot\Contracts\UserContract` in `app/Models/BaseRatingMorph.php`
- `Modules\Media\Models\Media` in `app/Models/Rating.php`
- Spatie: `SortableTrait`, `HasSlug`, `InteractsWithMedia`, `SchemalessAttributes`
- Filament 5: `Select`, `Textarea`, `TextInput`, `Fieldset`, `Component`, `Get`/`Set`

## Persistenza

Miglrazioni attive in `database/migrations/`:

- `2023_01_01_000000_create_ratings_table.php`
- `2023_01_01_000005_create_rating_morph_table.php`
- `2026_03_12_180000_create_ratings_table.php`
- `2026_03_27_000001_add_percentage_to_rating_morph_table.php`
- `2026_03_27_000002_add_percentage_to_rating_morph_table_on_rating_connection.php`
- `2026_06_16_000003_create_ratings_table.php`
- `2026_07_15_120003_create_rating_morph_table.php`
- `2026_07_27_100005_create_rating_morph_table.php`

Duplicati spostati in `database/migrations/_archive_redundant/` e `database/migrations/_bak/`.

## Test

`tests/Unit/` contiene test dedicati a: trait `HasRatingsTrait` (accessors, form data,
form field label, opzione «altro», `ratingsById`), `RatingData` (criteri→campi XLS,
form field label, data object), `BaseRating` (model + export XLS value), Filament
(schema, relation manager, esteso), `RuleEnum`, `SupportedLocale`, policy, widget dashboard.
`tests/Feature/RatingApiTest.php` e `tests/Fixtures/` (stub host, stub pivot) completano il quadro.

## Punto aperto verificato

`routes/web.php` e `routes/api.php` contengono solo `declare(strict_types=1);`: il modulo
non dichiara rotte proprie. Verificare chi monta `RatingApiTest`-like surface prima di
aggiungere endpoint.
