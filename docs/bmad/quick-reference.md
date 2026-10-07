---
<<<<<<< .merge_file_Qk6MBl
title: "Rating — Quick Reference"
type: note
module: Rating
tags:
  - bmad
  - rating
  - quick-reference
created: 2026-09-28
updated: 2026-09-28
qmd: "rating quick reference trait ratingdata risorse filament test"
related:
  - README.md
  - architecture.md
  - setup-guide.md
---

# Rating — Quick Reference

> **SUMMARY** — Riferimento rapido del modulo `Rating`: dove sta cosa, quali simboli usare,
> quali test leggere prima di toccare il codice. Paths relativi a `laravel/Modules/Rating`.

## SSoT e contratti

| Simbolo | Path |
|---------|------|
| `RatingData` (SSoT export/path/label) | `app/Datas/RatingData.php` |
| `RatingContract` | `app/Models/Contracts/RatingContract.php` |
| `HasRatingContract` | `app/Models/Contracts/HasRatingContract.php` |
| `RatingsFormCallerContract` | `app/Contracts/RatingsFormCallerContract.php` |
| `HasLikeContract` | `app/Contracts/HasLikeContract.php` |
| `RuleEnum` | `app/Enums/RuleEnum.php` |
| `SupportedLocale` | `app/Enums/SupportedLocale.php` |

Metodi chiave di `RatingData`: `ratingValuePath()`, `ratingXlsValuePath()`, `ratingFieldName()`,
`formFieldLabel()`, `getXlsFields()`, `criteriaToXlsFields()`, `updateColumns()`.

## Modelli

| File | Ruolo |
|------|-------|
| `app/Models/BaseRating.php` | base astratta del criterio (media, slug, sortabile, albero) |
| `app/Models/Rating.php` | concreta del catalogo |
| `app/Models/BaseRatingMorph.php` | base del pivot con `rating()`, `user()`, `profile()`, `model()` |
| `app/Models/RatingMorph.php` | concreta del pivot |
| `app/Models/BaseMorphPivot.php` | base pivot |
| `app/Models/AbstractRatingsHost.php` | base host |
| `app/Models/Like.php` | like |

## Trait host

| Metodo di `HasRatingsTrait` | Path |
|----------------------------|------|
| `ratingMorphs()`, `ratings()`, `ratingObjectives()`, `myRatings()` | `app/Models/Traits/HasRatingsTrait.php` |
| `ratingFormFields()`, `getRatingsFormSchema()` | idem |
| `hydrateRatingsFormData()`, `syncRatingsFormData()`, `clearRatingsFormData()` | idem |
| `getRatingsRules()`, `getRatingsValidationAttributes()` | idem |
| `ratingsById`, `ratingsAvg`, `ratingsCount`, `myRating` (accessor) | idem |
| `OTHER_OPTION_KEY = 'other'` (costante privata) | idem |

## Action

| Azione | Path |
|--------|------|
| Opzioni rating per host | `app/Actions/HasRating/GetRatingOptsByModelAction.php` |
| Conteggio host + rating | `app/Actions/HasRating/GetCountByModelRatingIdAction.php` |
| Somma host + rating | `app/Actions/HasRating/GetSumByModelRatingIdAction.php` |

## Filament

| Simbolo | Path |
|---------|------|
| Catalogo rating | `app/Filament/Resources/RatingResource.php` |
| Pivot rating-host | `app/Filament/Resources/RatingMorphResource.php` |
| Vista lato host | `app/Filament/Resources/HasRatingResource/` (directory: nessuna classe Resource, solo RelationManagers e Widgets) |
| Sezione form ratings | `app/Filament/Forms/Components/RatingsSection.php` |
| Decorazione campi | `app/Filament/Concerns/DecoratesRatingFormFields.php` |
| Colonna ratings | `app/Filament/Tables/Columns/RatingsColumn.php` |
| Filtro valori | `app/Filament/Tables/Filters/HasRatingValuesFilter.php` |
| Blocchi/pagine/widget | `app/Filament/Blocks/Rating.php`, `app/Filament/Pages/Dashboard.php`, `app/Filament/Widgets/StatsOverview.php` |

## Config e provider

- `config/config.php` — solo `name`, `icon`, `navigation_sort`.
- Provider: `app/Providers/RatingServiceProvider.php`, `app/Providers/Filament/AdminPanelProvider.php`,
  `app/Providers/RouteServiceProvider.php`, `app/Providers/EventServiceProvider.php`.
- `routes/web.php` e `routes/api.php` sono vuoti di rotte.

## Traduzioni

`lang/it/fields.php` (etichette campo, incluso `altro`), `lang/it/rating.php`, `lang/it/ratings.php`,
`lang/it/rating_form.php`, `lang/it/rating_infolist.php`, `lang/it/rating_morph.php`,
`lang/it/ratings_section.php`, `lang/it/child.php`, `lang/it/enums.php`, `lang/it/rule_enum.php`,
`lang/it/has_rating_values.php`, `lang/it/favorites.php`.

## Test da leggere prima di toccare il codice

| Test | Path |
|------|------|
| Trait: accessors | `tests/Unit/HasRatingsTraitAccessorsTest.php` |
| Trait: form data pivot | `tests/Unit/HasRatingsTraitFormDataTest.php` |
| Trait: opzione «altro» | `tests/Unit/HasRatingsTraitOtherOptionTest.php` |
| Trait: label campo | `tests/Unit/HasRatingsTraitFormFieldLabelTest.php` |
| Trait: `ratingsById` | `tests/Unit/HasRatingsTraitRatingsByIdTest.php` |
| SSoT export | `tests/Unit/RatingDataCriteriaToXlsFieldsTest.php` |
| SSoT label | `tests/Unit/RatingDataFormFieldLabelTest.php` |
| Export su modello | `tests/Unit/BaseRatingXlsExportValueTest.php` |
| Action host | `tests/Unit/HasRatingActionsTest.php` |
| Filament | `tests/Unit/RatingFilamentSchemaTest.php`, `RatingFilamentExtendedTest.php`, `RatingFilamentRelationManagerTest.php` |
| Modelli | `tests/Unit/BaseRatingModelTest.php`, `RatingMorphModelTest.php` |
| API | `tests/Feature/RatingApiTest.php` |
=======
title: "Rating — BMAD Quick Reference"
description: "Comandi rapidi BMAD per il modulo Rating"
module: "Rating"
alias: "rating"
documentation_date: "2026-09-29"
bmad_version: "6.2.0"
---

# Rating — BMAD Quick Reference

## Comandi Rapidi

### Help

```bash
bmad-help
```

### Workflow Rating

```bash
# Phase 1
bmad-domain-research      # Studio dominio: valutazioni, opzioni, note
bmad-technical-research   # Fattibilità attributi schemaless e morph pivot

# Phase 2
bmad-create-prd           # PRD: rating, opzioni, aggregati, «altro»
bmad-create-architecture  # Architettura BaseRating ↔ BaseRatingMorph ↔ host

# Phase 3
bmad-create-epics-and-stories            # Epic: trait host, pivot, form rating
bmad-check-implementation-readiness      # Quality gate

# Phase 4
bmad-sprint-planning      # Sprint iniziale
bmad-create-story         # Story: RatingMorphResource
bmad-dev-story            # Implementazione
bmad-code-review          # Review con focus regole e pivot
```

### Agenti per Rating

| Agente | Skill | Scopo |
|--------|-------|-------|
| Mary (analyst) | `skill: "bmad-agent-analyst"` | ricerca modelli di valutazione |
| John (pm) | `skill: "bmad-agent-pm"` | PRD regole e scale |
| Winston (architect) | `skill: "bmad-agent-architect"` | architettura morph e schemaless |
| Amelia (dev) | `skill: "bmad-agent-dev"` | implementazione trait e Action |
| Quinn (qa) | `skill: "bmad-agent-qa"` | test regole, pivot, «altro» |

## Classi Chiave

### Contracts

| Contract | Ruolo |
|---|---|
| `app/Models/Contracts/RatingContract` | Contratto del modello rating — **usare questo nelle firme** |
| `app/Models/Contracts/HasRatingContract` | Host che espone rating |
| `app/Contracts/HasLikeContract` | Host che espone like |
| `app/Contracts/RatingsFormCallerContract` | Caller del form rating |

### Enums (`app/Enums/`)

- `RuleEnum` → `Null` (`''`), `ZeroFour`, `ZeroFive`, `ZeroSix`,
  `ZeroOrMin4Max25`, `NullableNumericMin0Max25` — regole di validazione
- `SupportedLocale` → `it`, `en`

### Actions (`app/Actions/`)

| Action | Ruolo |
|---|---|
| `GetCountByModelRatingIdAction` | Conteggio rating per host |
| `GetSumByModelRatingIdAction` | Somma rating per host |
| `GetRatingOptsByModelAction` | Opzioni disponibili per un host |
| `HasRating/` | Sottodominio `HasRating` |

### Models (`app/Models/`)

- `BaseRating`, `BaseRatingMorph` — basi riusabili dai moduli host
- `Rating`, `RatingMorph` — implementazioni concrete
- `AbstractRatingsHost`, `Like` — aggregato e like
- **Traits**: `HasRatingsTrait` (form pivot), `HasRating`, `HasLikes`, `RatingTrait`
- **Aggregates**: `BettableAggregate` (stati `to_predict`, `to_rating`)

### Filament 5

- **Resources**: `RatingResource`, `RatingMorphResource`, `BaseRatingResource`,
  `BaseRatingMorphResource`, `HasRatingResource`
- **Widget**: `StatsOverview`
- **Extra**: `Blocks/`, `Sections/`, `Forms/`, `Concerns/`, `Tables/`, `RelationManagers/`

## Pattern del Modulo

- Con figli: **Select + Textarea sempre visibili** in un `Fieldset` a 2 colonne;
  `Fieldset::setUp()` imposta già `columns(2)`, usare `columnSpan(2)` sul wrapper
- Select → `pivot.value`; Textarea → `pivot.note` via `ratingFieldName(..., 'note')`
- «Altro» = chiave `'other'` (`OTHER_OPTION_KEY`), **mai** `''` (la stringa vuota
  collassa a `null` e la nota non diventa mai obbligatoria)
- Gate: `selectIsOther($value)` → `$value === 'other'`; **mai** `blank()`
- Validazione Select con figli: `Rule::in(chiavi options)`, **non** `RuleEnum`
- Fill/save generico: `hydrateRatingsFormData()` / `syncRatingsFormData()`
- Tipizzare su `RatingContract`, mai su `BaseRating`

## Verifica

```bash
cd laravel

php -d memory_limit=2G ./vendor/bin/phpstan analyse Modules/Rating
./vendor/bin/pest Modules/Rating
./vendor/bin/pint
```

## Quick Flow

```bash
bmad-quick-dev "Aggiungi opzione «altro» a un nuovo rating con figli"
bmad-quick-spec "Specifica regola di validazione scala 0-25"
```

---

*Rating · BMAD Quick Reference · data 2026-09-29*
>>>>>>> .merge_file_XDQbg5
