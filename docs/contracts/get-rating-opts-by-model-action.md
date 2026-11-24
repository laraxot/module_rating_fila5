---
title: "Contratto — GetRatingOptsByModelAction"
type: contract
action: "Modules\Rating\Actions\HasRating\GetRatingOptsByModelAction"
tags: [contract, action, rating, options]
created: 2026-11-24
updated: 2026-11-24
---

# GetRatingOptsByModelAction

Sorgente: `app/Actions/HasRating/GetRatingOptsByModelAction.php`. Nel checkout attuale non ha chiamanti in produzione (`StatsOverview` ripete il filtro a mano). Semantica di `rating_morph`:
[ADR opzioni e voti nella stessa pivot](../adr/rating-morph-options-and-votes-same-pivot.md).

## Input

- `HasRatingContract $model`: il model di cui si vogliono le opzioni di voto.

## Output

- `array<int, string|null>`: id del criterio → `title` (`null` se il titolo non è una stringa).

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| RATING-OPTS-INV-1 | Solo le righe-opzione: pivot con `user_id` nullo; i voti non producono opzioni. | `RATING-OPTS-INV-1` |
| RATING-OPTS-INV-2 | Le chiavi sono gli id interi di `ratings.id`, i valori il `title` del criterio. | `RATING-OPTS-INV-2` |

## Effetti collaterali

- Una query di lettura (`pluck`). Nessuna scrittura.

## Errori

- Nessuna eccezione propria; errori del database risalgono.

## Non fa

- Non traduce il titolo né usa `txt` (il nome leggibile): ritorna `title`, il nome tecnico.
- Non ordina e non filtra per `is_readonly` o regola.
- Non attiva né disattiva opzioni: le righe-opzione si creano altrove (attach sulla relazione `ratings()`).
