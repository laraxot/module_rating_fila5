---
title: "Contratto — GetSumByModelRatingIdAction"
type: contract
action: "Modules\\Rating\\Actions\\HasRating\\GetSumByModelRatingIdAction"
module: Rating
status: active
tags: [contract, action, rating, aggregate]
created: 2026-11-26
updated: 2026-11-26
---

# GetSumByModelRatingIdAction

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`). Perche': ADR [0002](../adr/0002-rating-morph-options-and-votes-same-pivot.md) (opzioni e voti nella stessa pivot).
Sorgente: `app/Actions/HasRating/GetSumByModelRatingIdAction.php`. Chiamante di produzione: nessuno nel modulo (`rg GetSumByModelRatingId app --glob '*.php'` trova solo la classe).
Aggrega i voti sul pivot `rating_morph.value`; non duplica [GetRatingOptsByModelAction](get-rating-opts-by-model-action.md) (opzioni, non somme).

## Input

- `HasRatingContract $model`.
- `?string $rating_id`: se valorizzato restringe la somma a quel rating.

## Output

- `float`: somma di `rating_morph.value` sulle pivot con `user_id` non nullo; `0.0` se il risultato non e' numerico.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| RATING-VOTES-SUM-INV-1 | Somma solo le pivot con `user_id` non nullo (i voti), mai le righe-opzione. Se cade, le opzioni entrano nei totali. | `RATING-VOTES-SUM-INV-1` |
| RATING-VOTES-SUM-INV-2 | Con `$rating_id` filtra anche `wherePivot('rating_id', $rating_id)`. | `RATING-VOTES-SUM-INV-2` |
| RATING-VOTES-SUM-INV-3 | Un risultato non numerico diventa `0.0`, mai `null` ne' un errore. | `RATING-VOTES-SUM-INV-3` |
| RATING-VOTES-SUM-INV-4 | Solo lettura: nessuna scrittura su `ratings` ne' `rating_morph`. | `RATING-VOTES-SUM-INV-4` |

## Effetti collaterali

- Una `SELECT SUM` sulla relazione `ratings()` del model. Nessuna scrittura, nessun evento.

## Errori

- Gli errori Eloquent/DB della relazione risalgono al chiamante.

## Non fa

- Non scrive voti (`HasRatingsTrait::syncRatingsFormData`, vedi [has-ratings-trait](has-ratings-trait.md)).
- Non conta le righe: lo fa [GetCountByModelRatingIdAction](get-count-by-model-rating-id-action.md).

## Limiti noti

- **I test usano un mock della relazione** (`Mockery::mock(MorphToMany::class)`, `tests/Unit/HasRatingActionsTest.php`): provano quali filtri l'Action applica e che non chiama altri metodi (un `attach` o `update` farebbe fallire il mock), non il risultato su un database. INV-4 vale per la relazione passata, non per un'eventuale `DB::` dentro l'Action.
- `ratings()` vede solo la forma alias di `model_type`: dove la stessa entita' ha righe con alias e con FQCN, la somma esclude la seconda forma (story `rating-morph-model-type-doppio`; `HasRatingsTrait::ratingMorphs()` legge entrambe).

## Riconciliazione documentale (2026-11-27)

Questo file aveva un conflitto Git irrisolto. La base è la variante più recente del contratto, con il riferimento a `app/Actions/HasRating/GetSumByModelRatingIdAction.php` **esistente su `dev`**; la sua semantica, i group Pest citati e gli eventuali effetti non sono stati rieseguiti in questa sessione. Il confronto con il codice e i test resta il gate ECC della story owner. [Tracciamento root #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
