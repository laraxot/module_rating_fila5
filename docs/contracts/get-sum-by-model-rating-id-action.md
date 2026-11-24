---
title: "GetSumByModelRatingIdAction — contratto"
type: contract
owner: Rating
status: accepted
updated: 2026-11-24
action: "Modules\\Rating\\Actions\\HasRating\\GetSumByModelRatingIdAction"
qmd: "GetSumByModelRatingIdAction somma voti rating_morph value user_id pivot"
---

# GetSumByModelRatingIdAction

Somma i voti ricevuti da un modello valutabile. Codice: `app/Actions/HasRating/GetSumByModelRatingIdAction.php:21-31`.

## Input

- `HasRatingContract $model`: modello con relazione `ratings()` (MorphToMany).
- `?string $rating_id`: se valorizzato, limita la somma a quel criterio.

## Output

- `float`: somma di `rating_morph.value`; `0.0` se il risultato non è numerico (riga 30).

## Invarianti

| ID | Regola | Prova nel codice | Test |
|---|---|---|---|
| `RATING-SUM-INV-1` | Sono sommati solo i voti del pivot con `user_id` non nullo (voti senza votante esclusi). | righe 24, 28 | `tests/Unit/HasRatingActionsTest.php:43` (somma; esclusione `user_id` nullo non esplicita nel nome del test) |
| `RATING-SUM-INV-2` | Con `$rating_id` la somma è ristretta al pivot di quel `rating_id`. | righe 25-27 | `tests/Unit/HasRatingActionsTest.php:54` |
| `RATING-SUM-INV-3` | Un risultato non numerico produce `0.0`. | riga 30 | `tests/Unit/HasRatingActionsTest.php:65` |

## Effetti collaterali

Nessuno: una sola query di aggregazione in lettura. Nessuna scrittura, evento, coda o servizio esterno.

## Errori

- Nessuna eccezione propria; gli errori del database si propagano.

## Non fa

- Non verifica che il chiamante possa vedere i voti: l'autorizzazione è delle policy (vedi [rating-morph-policy](rating-morph-policy.md)).
- Non espone né aggrega dati personali del votante: usa `user_id` solo come filtro.
