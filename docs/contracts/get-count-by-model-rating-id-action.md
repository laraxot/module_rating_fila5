---
title: "Contratto — GetCountByModelRatingIdAction"
type: contract
<<<<<<< .merge_file_xb74yE
action: "Modules\Rating\Actions\HasRating\GetCountByModelRatingIdAction"
tags: [contract, action, rating, aggregate]
created: 2026-11-24
updated: 2026-11-24
=======
action: "Modules\\Rating\\Actions\\HasRating\\GetCountByModelRatingIdAction"
module: Rating
status: active
tags: [contract, action, rating, aggregate]
created: 2026-11-26
updated: 2026-11-26
>>>>>>> .merge_file_OP6HuD
---

# GetCountByModelRatingIdAction

<<<<<<< .merge_file_xb74yE
Sorgente: `app/Actions/HasRating/GetCountByModelRatingIdAction.php`. Chiamante: `Filament/Widgets/StatsOverview.php`
(i "players" per criterio e totali). Semantica di `rating_morph`:
[ADR opzioni e voti nella stessa pivot](../adr/rating-morph-options-and-votes-same-pivot.md).

## Input

- `HasRatingContract $model`: il model valutato.
- `?string $rating_id`: un criterio; `null` = tutti i criteri del model.

## Output

- `float` (il tipo di ritorno è `float` anche se il valore è un intero): numero di voti con `value` non nullo.
=======
Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`). Perche': ADR [0002](../adr/0002-rating-morph-options-and-votes-same-pivot.md).
Sorgente: `app/Actions/HasRating/GetCountByModelRatingIdAction.php`. Chiamante di produzione: nessuno nel modulo (`rg GetCountByModelRatingId app --glob '*.php'` trova solo la classe).
Non duplica [GetSumByModelRatingIdAction](get-sum-by-model-rating-id-action.md) ne' [GetRatingOptsByModelAction](get-rating-opts-by-model-action.md).

## Input

- `HasRatingContract $model`, `?string $rating_id`.

## Output

- `float`: `count('rating_morph.value')` sulle pivot con `user_id` non nullo (e, se passato, di quel rating).
>>>>>>> .merge_file_OP6HuD

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
<<<<<<< .merge_file_xb74yE
| RATING-VOTES-COUNT-INV-1 | Conta solo i voti: righe pivot con `user_id` non nullo; le righe-opzione non entrano mai. | `RATING-VOTES-COUNT-INV-1` |
| RATING-VOTES-COUNT-INV-2 | Con `$rating_id` filtra su quel criterio; senza, conta su tutti i criteri del model. | `RATING-VOTES-COUNT-INV-2` |

## Effetti collaterali

- Una query di lettura (`COUNT(rating_morph.value)`). Nessuna scrittura.

## Errori

- Nessuna eccezione propria; errori del database risalgono.

## Non fa

- Non conta gli utenti distinti (lo fa `HasRating::getBettingUsers()`): un utente con due voti conta due.
- Non conta le righe con `value` nullo (`COUNT` di colonna).
- Non mette in cache.
=======
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
>>>>>>> .merge_file_OP6HuD
