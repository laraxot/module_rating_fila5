# Story: rating-data-export-methods

**Status**: ready-for-dev
**Modulo**: Rating
**Epic**: utility rating riutilizzabili per export XLS

## AC
- [ ] `formFieldLabel` spostato da `HasRatingsTrait` a `RatingData`
- [ ] `ratingXlsValuePath` spostato da `HasRatingsTrait` a `RatingData`
- [ ] `RatingData::getXlsFields($where)` usa i nuovi metodi (DRY)
- [ ] `HasRatingsTrait` mantiene solo relazioni/scope/sync (no utility export)
- [ ] Tutti i callers aggiornati (`RatingData`, `CompilaIndennitaResponsabilita`, `DecoratesRatingFormFields`, test)
- [ ] PHPStan Modules/Rating [OK]
- [ ] PHPStan Modules/IndennitaResponsabilita [OK]
- [ ] Pest verdi su moduli toccati
- [ ] Second brain aggiornato con la nuova regola

## Note
- Questo refactoring rende più riutilizzabile la logica di label/export dei rating.
- `RatingData` è il DTO di rating; contiene anche utility statiche di rating.
- `HasRatingsTrait` rimane il dominio delle relazioni (`ratings`, `ratingMorphs`, `myRatings`, ecc.).
