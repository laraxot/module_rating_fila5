---
title: "Contratto — GetCountByModelRatingIdAction"
type: contract
action: "Modules\Rating\Actions\HasRating\GetCountByModelRatingIdAction"
tags: [contract, action, rating, aggregate]
created: 2026-11-24
updated: 2026-11-24
---

# GetCountByModelRatingIdAction

Sorgente: `app/Actions/HasRating/GetCountByModelRatingIdAction.php`. Chiamante: `Filament/Widgets/StatsOverview.php`
(i "players" per criterio e totali). Semantica di `rating_morph`:
[ADR opzioni e voti nella stessa pivot](../adr/rating-morph-options-and-votes-same-pivot.md).

## Input

- `HasRatingContract $model`: il model valutato.
- `?string $rating_id`: un criterio; `null` = tutti i criteri del model.

## Output

- `float` (il tipo di ritorno è `float` anche se il valore è un intero): numero di voti con `value` non nullo.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
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
