---
title: "GetCountByModelRatingIdAction — contratto"
type: contract
owner: Rating
status: accepted
updated: 2026-11-24
action: "Modules\\Rating\\Actions\\HasRating\\GetCountByModelRatingIdAction"
qmd: "GetCountByModelRatingIdAction conteggio voti rating_morph value user_id pivot"
---

# GetCountByModelRatingIdAction

Conta i voti ricevuti da un modello valutabile. Codice: `app/Actions/HasRating/GetCountByModelRatingIdAction.php:21-30`.

## Input

- `HasRatingContract $model`: modello con relazione `ratings()` (MorphToMany).
- `?string $rating_id`: se valorizzato, limita il conteggio a quel criterio.

## Output

- `float` dichiarato: il valore reale è il `int` restituito da `count('rating_morph.value')` (riga 29), convertito dal tipo di ritorno.

## Invarianti

| ID | Regola | Prova nel codice | Test |
|---|---|---|---|
| `RATING-COUNT-INV-1` | Sono contati solo i voti del pivot con `user_id` non nullo. | righe 24, 29 | `tests/Unit/HasRatingActionsTest.php:31` |
| `RATING-COUNT-INV-2` | Con `$rating_id` il conteggio è ristretto al pivot di quel `rating_id`. | righe 25-27 | Test: nessuno |

## Effetti collaterali

Nessuno: una sola query di aggregazione in lettura.

## Errori

- Nessuna eccezione propria; gli errori del database si propagano.

## Non fa

- Non verifica i permessi di lettura dei voti (vedi [rating-morph-policy](rating-morph-policy.md)).
- Dubbio: il ritorno è dichiarato `float` ma il valore è un `int`; il contratto non dipende dal tipo esatto.
