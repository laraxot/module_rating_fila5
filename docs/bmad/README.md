---
<<<<<<< .merge_file_biI7qW
title: "Rating — indice BMAD"
type: note
=======
title: "BMAD Rating — Select altro / note"
type: index
>>>>>>> .merge_file_RsJIOI
module: Rating
tags:
  - bmad
  - rating
  - indice
created: 2026-09-28
updated: 2026-09-28
qmd: "rating bmad indice documentazione rating morph trait"
related:
  - architecture.md
  - architecture/module-boundary.md
  - brainstorming.md
  - epics/rating-export-ssot.md
  - quick-reference.md
  - setup-guide.md
---

# Rating — indice BMAD

> **SUMMARY** — Indice dei documenti BMAD del modulo `Rating` (`laravel/Modules/Rating`).
> Il modulo gestisce catalogo dei rating, pivot `RatingMorph` su host polimorfici, trait
> `HasRatingsTrait` per i form e l'export XLS centralizzato in `RatingData`.
> I path sono relativi a `laravel/Modules/Rating/docs/bmad/`.

## Documenti canonici

| Documento | Path |
|-----------|------|
| Architettura (indice) | [architecture.md](architecture.md) |
| Architettura — confini di modulo | [architecture/module-boundary.md](architecture/module-boundary.md) |
| Brainstorming (indice) | [brainstorming.md](brainstorming.md) |
| Epic — export SSoT | [epics/rating-export-ssot.md](epics/rating-export-ssot.md) |
| Epic — opzione «altro» | [epics/rating-select-altro.md](epics/rating-select-altro.md) |
| Epic — roadmap | [epics/module-roadmap.md](epics/module-roadmap.md) |
| Quick reference | [quick-reference.md](quick-reference.md) |
| Setup guide | [setup-guide.md](setup-guide.md) |

## Shard di architettura

| Shard | Oggetto |
|-------|---------|
| [architecture/rating-select-altro-note.md](architecture/rating-select-altro-note.md) | contratto nota obbligatoria su «altro» |
| [architecture/rating-select-altro-implementation-spec.md](architecture/rating-select-altro-implementation-spec.md) | spec del codice per select + textarea |
| [architecture/rating-data-export-methods.md](architecture/rating-data-export-methods.md) | metodi export di `RatingData` |
| [architecture/ratingdata-getxlsfields-caller-resolve.md](architecture/ratingdata-getxlsfields-caller-resolve.md) | risoluzione del caller di `getXlsFields()` |
| [architecture/rating-entity-helpers-home-in-ratingdata.md](architecture/rating-entity-helpers-home-in-ratingdata.md) | home degli helper sull'entita |
| [architecture/rating-export-fields-reusable.md](architecture/rating-export-fields-reusable.md) | campi export riusabili |
| [architecture/rating-xls-fields-reusable.md](architecture/rating-xls-fields-reusable.md) | campi XLS riusabili |
| [architecture/rating-table-component.md](architecture/rating-table-component.md) | componente tabella rating |
| [architecture/form-field-label-and-xls-path-home.md](architecture/form-field-label-and-xls-path-home.md) | label campo form e path XLS |

## Shard di brainstorming

| Shard | Oggetto |
|-------|---------|
| [brainstorming/rating-select-altro-note-obbligatoria.md](brainstorming/rating-select-altro-note-obbligatoria.md) | nota obbligatoria su «altro» |
| [brainstorming/rating-data-export-methods.md](brainstorming/rating-data-export-methods.md) | metodi export |
| [brainstorming/rating-export-fields-reusable.md](brainstorming/rating-export-fields-reusable.md) | riusabilita campi export |
| [brainstorming/rating-table-component.md](brainstorming/rating-table-component.md) | componente tabella |
| [brainstorming/rating-xls-fields-home.md](brainstorming/rating-xls-fields-home.md) | home dei campi XLS |
| [brainstorming/module-opportunities.md](brainstorming/module-opportunities.md) | opportunita di modulo |

## Codice del modulo in mappa rapida

| Area | Path |
|------|------|
| Modelli | `app/Models/` — `BaseRating.php`, `Rating.php`, `BaseRatingMorph.php`, `RatingMorph.php`, `BaseMorphPivot.php`, `Like.php`, `AbstractRatingsHost.php`, `BaseModel.php`, `Traits/HasRatingsTrait.php`, `Traits/HasRating.php`, `Traits/HasLikes.php`, `Contracts/RatingContract.php`, `Contracts/HasRatingContract.php` |
| Dati | `app/Datas/RatingData.php`, `app/Datas/RatingMorphData.php`, `app/Datas/RatingBlockData.php`, `app/DataObjects/RatingData.php` |
| Enums | `app/Enums/RuleEnum.php`, `app/Enums/SupportedLocale.php` |
| Action | `app/Actions/HasRating/GetCountByModelRatingIdAction.php`, `GetRatingOptsByModelAction.php`, `GetSumByModelRatingIdAction.php` |
| Filament | `app/Filament/Resources/RatingResource.php`, `RatingMorphResource.php`, `BaseRatingResource.php`, `app/Filament/Resources/HasRatingResource/` (solo RelationManagers e Widgets), `BaseRatingMorphResource.php`, `app/Filament/Forms/Components/RatingsSection.php`, `app/Filament/Concerns/DecoratesRatingFormFields.php`, `app/Filament/Tables/Columns/RatingsColumn.php`, `app/Filament/Tables/Filters/HasRatingValuesFilter.php` |
| Provider | `app/Providers/RatingServiceProvider.php`, `app/Providers/Filament/AdminPanelProvider.php`, `app/Providers/EventServiceProvider.php`, `app/Providers/RouteServiceProvider.php` |
| Config | `config/config.php` (solo `name`, `icon`, `navigation_sort`) |
| Lang | `lang/it/rating.php`, `lang/it/ratings.php`, `lang/it/fields.php`, `lang/it/enums.php`, `lang/it/rule_enum.php`, `lang/it/rating_form.php`, `lang/it/rating_infolist.php`, `lang/it/rating_morph.php`, `lang/it/ratings_section.php`, `lang/it/child.php`, `lang/it/has_rating_values.php`, `lang/it/favorites.php` |
| Test | `tests/Unit/` (27 file), `tests/Feature/RatingApiTest.php`, `tests/Fixtures/` |
| Database | `database/migrations/` (6 attive + 2 in `_archive_redundant/` + 2 in `_bak/`), `database/factories/`, `database/seeders/` |
| Routes | `routes/web.php`, `routes/api.php` — entrambi contengono solo `declare(strict_types=1);`: nessuna rotta dichiarata |

## Metodo di riferimento

- [../../../Xot/docs/bmad-method.md](../../../Xot/docs/bmad-method.md)
- [../../../Xot/docs/bmad/stories/5.249-bmad-docs-fleet-completion.story.md](../../../Xot/docs/bmad/stories/5.249-bmad-docs-fleet-completion.story.md)
