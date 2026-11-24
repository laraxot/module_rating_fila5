---
title: "GetRatingOptsByModelAction — contratto"
type: contract
owner: Rating
status: accepted
updated: 2026-11-24
action: "Modules\\Rating\\Actions\\HasRating\\GetRatingOptsByModelAction"
qmd: "GetRatingOptsByModelAction opzioni criteri rating titolo user_id null pivot"
---

# GetRatingOptsByModelAction

Elenca i criteri (opzioni di voto) associati a un modello, cioè le righe pivot senza votante. Codice: `app/Actions/HasRating/GetRatingOptsByModelAction.php:21-34`.

## Input

- `HasRatingContract $model`: modello con relazione `ratings()` (MorphToMany).

## Output

- `array<int, string|null>`: mappa `ratings.id` => titolo; il titolo è `null` se non è una stringa (righe 25-33).

## Invarianti

| ID | Regola | Prova nel codice | Test |
|---|---|---|---|
| `RATING-OPTS-INV-1` | Sono elencate solo le righe pivot con `user_id` nullo (opzioni, non voti). | riga 27 | `tests/Unit/HasRatingActionsTest.php:75` |
| `RATING-OPTS-INV-2` | Le chiavi sono `int` (cast da `ratings.id`). | riga 31 | Test: nessuno |
| `RATING-OPTS-INV-3` | Un titolo non stringa diventa `null` invece di essere scartato. | riga 32 | Test: nessuno |

## Effetti collaterali

Nessuno: una sola query in lettura (`pluck`).

## Errori

- Nessuna eccezione propria; gli errori del database si propagano.

## Non fa

- Non filtra per lingua: il titolo è quello grezzo della colonna `ratings.title`.
- Non conta i voti (vedi `GetCountByModelRatingIdAction` e `GetSumByModelRatingIdAction`).
