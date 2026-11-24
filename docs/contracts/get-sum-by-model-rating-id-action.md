---
title: "Contratto — GetSumByModelRatingIdAction"
type: contract
action: "Modules\Rating\Actions\HasRating\GetSumByModelRatingIdAction"
tags: [contract, action, rating, aggregate]
created: 2026-11-24
updated: 2026-11-24
---

# GetSumByModelRatingIdAction

Sorgente: `app/Actions/HasRating/GetSumByModelRatingIdAction.php`. Chiamante: `Filament/Widgets/StatsOverview.php`
(il "volume" per criterio e totale). Semantica di `rating_morph`:
[ADR opzioni e voti nella stessa pivot](../adr/rating-morph-options-and-votes-same-pivot.md).

## Input

- `HasRatingContract $model`: il model valutato.
- `?string $rating_id`: un criterio; `null` = tutti i criteri del model.

## Output

- `float`: somma di `rating_morph.value` dei voti; `0.0` se la somma non è numerica (nessun voto).

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| RATING-VOTES-SUM-INV-1 | Somma solo i voti: righe pivot con `user_id` non nullo; le righe-opzione non entrano mai. | `RATING-VOTES-SUM-INV-1` |
| RATING-VOTES-SUM-INV-2 | Con `$rating_id` filtra su quel criterio; senza, somma su tutti i criteri del model. | `RATING-VOTES-SUM-INV-2` |
| RATING-VOTES-SUM-INV-3 | Mai `null`: senza voti ritorna `0.0`. | `RATING-VOTES-SUM-INV-3` |

## Effetti collaterali

- Una query di lettura (`SUM`) sulla connessione della relazione `ratings()` del model. Nessuna scrittura.

## Errori

- Nessuna eccezione propria; errori del database risalgono.

## Non fa

- Non somma `points` (lo fa `HasRating::getVolumeCredit()`, che è un'altra misura).
- Non distingue per utente né deduplica: due voti dello stesso utente contano due volte.
- Non controlla che `$rating_id` sia un'opzione attiva del model.
- Non mette in cache.
