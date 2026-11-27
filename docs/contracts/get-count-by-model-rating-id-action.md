---
title: "Contratto — GetCountByModelRatingIdAction"
type: contract
action: "Modules\\Rating\\Actions\\HasRating\\GetCountByModelRatingIdAction"
module: Rating
status: active
tags: [contract, action, rating, aggregate]
created: 2026-11-26
updated: 2026-11-26
---

# GetCountByModelRatingIdAction

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`). Perche': ADR [0002](../adr/0002-rating-morph-options-and-votes-same-pivot.md).
Sorgente: `app/Actions/HasRating/GetCountByModelRatingIdAction.php`. Chiamante di produzione: nessuno nel modulo (`rg GetCountByModelRatingId app --glob '*.php'` trova solo la classe).
Non duplica [GetSumByModelRatingIdAction](get-sum-by-model-rating-id-action.md) ne' [GetRatingOptsByModelAction](get-rating-opts-by-model-action.md).

## Input

- `HasRatingContract $model`, `?string $rating_id`.

## Output

- `float`: `count('rating_morph.value')` sulle pivot con `user_id` non nullo (e, se passato, di quel rating).

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| RATING-VOTES-COUNT-INV-1 | Conta solo le pivot con `user_id` non nullo (i voti), mai le righe-opzione. Se cade, `COUNT` e percentuali includono le opzioni. | `RATING-VOTES-COUNT-INV-1` |
| RATING-VOTES-COUNT-INV-2 | Con `$rating_id` filtra anche `wherePivot('rating_id', $rating_id)` e conta la colonna `rating_morph.value`. | `RATING-VOTES-COUNT-INV-2` |
| RATING-VOTES-COUNT-INV-3 | Solo lettura: nessuna scrittura su `ratings` ne' `rating_morph`. | `RATING-VOTES-COUNT-INV-3` |

## Effetti collaterali

- Una `SELECT COUNT` sulla relazione `ratings()` del model. Nessuna scrittura, nessun evento.

## Errori

- Gli errori Eloquent/DB risalgono al chiamante.

## Non fa

- Non somma i valori (`GetSumByModelRatingIdAction`) e non e' il percorso di scrittura dei voti.

## Limiti noti

- **Conta i valori, non le righe.** `COUNT(rating_morph.value)` ignora le righe con `value` nullo: un voto «altro» o senza scelta, che `HasRatingsTrait::syncRatingsFormData` scrive con `value = null` e una nota (righe 523-525), non entra nel conteggio. Letto dal codice, non misurato su dati.
- Come per la somma, i test usano un mock della relazione (provano i filtri, non il risultato su database) e `ratings()` vede solo la forma alias di `model_type`.

## Riconciliazione documentale (2026-11-27)

Questo file aveva un conflitto Git irrisolto. La base è la variante più recente del contratto, con il riferimento a `app/Actions/HasRating/GetCountByModelRatingIdAction.php` **esistente su `dev`**; la sua semantica, i group Pest citati e gli eventuali effetti non sono stati rieseguiti in questa sessione. Il confronto con il codice e i test resta il gate ECC della story owner. [Tracciamento root #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
