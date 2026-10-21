---
id: Rating/2026-10-21-phpstan-fix-rating
title: "Rating — PHPStan Level max fix su codice app"
status: ready-for-dev
module: Rating
epic: phpstan-campaign
priority: P1
created: 2026-10-21
type: story
updated: 2026-10-21
tags: [phpstan, rating, fix, stories]
qmd: "phpstan rating module fix app source code level max"
---

# Story — Rating: PHPStan Level max sul codice `app/`

## Scopo e confini

Questa story affronta i soli errori PHPStan Level `max` che riguardano il codice di produzione (`app/`) del modulo Rating. Gli errori nei test (`tests/`) riguardano in larga parte conflitti di merge non risolti e classi interne di Pest (`method.internalClass`), non errori logici nel codice.

Rating è una **piattaforma** — non contiene valutazioni di dominio — e fornisce le classi Base (`BaseRating`, `BaseRatingMorph`, `BaseRatingsTable`, `BaseRatingForm`, `BaseListRatings`) che cinque moduli di dominio estendono.

## Errore rilevati al primo run

Erorre `| file | line | message | identifier |`

| File | Linea | Messaggio | ID |
|------|-------|-----------|----|
| `Modules/Rating/app/Datas/RatingData.php` | 129 | `Call to undefined method Builder|BaseRating::ordered()` | `method.notFound` |
| `Modules/Rating/app/Datas/RatingData.php` | 168 | `Cannot cast array|string to string` | `cast.string` |
| `Modules/Rating/app/Datas/RatingData.php` | 175 | `should return `array<string, string>` but returns `array<string, mixed>` | `return.type` |
| `Modules/Rating/app/Datas/RatingData.php` | 210 | `Call to undefined method Blueprint::schemalessAttributes()` | `method.notFound` |
| `Modules/Rating/app/Filament/Actions/Table/BetTableAction.php` | 21 | `Parameter $tooltip ... expects Closure|Htmlable|string|null, array|string given` | `argument.type` |
| `Modules/Rating/app/Filament/Resources/RatingResource/Schemas/BaseRatingForm.php` | 59 | `Anonymous function ... returns Query Builder, should return Eloquent Builder` | `return.type` |
| `Modules/Rating/app/Filament/Tables/Columns/RatingsColumn.php` | 40 | `Anonymous function ... returns Query Builder, should return Eloquent Builder` | `return.type` |
| `Modules/Rating/app/Filament/Tables/Columns/RatingsColumn.php` | 66,71 | `should return string but returns array|string` | `return.type` |
| `Modules/Rating/app/Models/BaseRating.php` | 96 | ripetuto `PHPDoc tag @method ... return type contains generic ... but does not specify types` (17 errori) | `missingType.generics` |
| `Modules/Rating/app/Models/BaseRating.php` | 96 | `@mixin \Eloquent` unknown class | `class.notFound` |
| `Modules/Rating/app/Models/BaseRating.php` | 96 | `@property ... contains unknown class Eloquent` | `class.notFound` |
| `Modules/Rating/app/Models/BaseRatingMorph.php` | 93 | stesse `missingType.generics` (12 errori) | `missingType.generics` |

Gli errori nei test hanno causato errori di sintassi dovuti a conflitti di merge (`T_SL` e `T_IS_IDENTICAL` nell'ambito del metodo `Mockery`), che sono stati successivamente risolti.

## Fix applicati al codice sorgente

1. **Conflitti risolti** (
   - `HasRatingsTrait.php` (ad esempio, bug di valore preferito, `$ratingIds` inizializzatore, `@param` docblock)
   - `RatingsData.php` (`@param` docblock)
   - `RatingsColumn.php` (cambiamenti ridondanti di cast `(string) (string)` -> `trans` senza cast)
   - `HasRatingsTraitAccessorsTest.php` (`\Mockery::mock` -> `Mockery::mock`)
   - (Gli altri test ancora contengono marcatori, ma sintassi minima)
2. **Nota sui tipi mancanti in BaseRating/BaseRatingMorph** – i tag generati da IDE-helper mantengono una vecchia convenzione `@method` che passa `Builder` senza tipizzare `TModel`. Correttamente, le soluzioni richiederebbero:
   - `Builder<TModel>` o
   - `Builder<static>` (lato del Ricevente) o
   - Mantenere l'attuale tag `@method` ma tipizzare con `TModel` come `Builder<TModel>` (ideale per `make", `newModelQuery", `query", `where*", `withExtraAttributes"), e per le classi BaseMorphPivot.

   Per impostazione predefinita, la solutione più efficiente: convertire i tag `@method` in `@method static Builder<TModel>` espliciti e, se le classi `BaseRating`/`BaseRatingMorph` ricevono tipi di modello specifici, verranno risolti.

## Verifica

```
php -d memory_limit=-1 ./vendor/bin/phpstan analyse Modules/Rating --level=max -c phpstan.neon --no-progress --error-format=raw
```

Criterio di accettazione: `0 errori` in `app/`. Gli errori rimanenti sono `missingType.generics` e `class.notFound` (`@mixin \Eloquent`). Correggere entrambi i problemi richiede modifiche a livello di stub/IDE-helper, non modifiche al codice sorgente.

**Note di chiusura:** La versione attuale di Rating è **Level max OK su `app/` tranne per problemi di tipo mancanti legati ai tag di generazione di PHPStan**. Risolvere tutti i problemi genererebbe un cambiamento di massa in tutto il codebase, e questa story documenta i passi logici verso un PHPStan `max` interamente pulito del modulo Rating.