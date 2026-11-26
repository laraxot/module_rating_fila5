---
title: "Contratto — GetRatingOptsByModelAction"
type: contract
action: "Modules\\Rating\\Actions\\HasRating\\GetRatingOptsByModelAction"
module: Rating
status: accepted
updated: 2026-11-26
---

# GetRatingOptsByModelAction

Classe: `Modules\\Rating\\Actions\\HasRating\\GetRatingOptsByModelAction`

## Input

- `HasRatingContract $model`

## Output

- `array` delle opzioni di rating per il modello.

## Invarianti

| ID | Regola | Verifica |
|---|---|---|
| RATING-OPTS-INV-1 | Legge le opzioni dal perimetro morph del modello; non inventa opzioni hard-coded nel tema. | `->group('RATING-OPTS-INV-1')` |
| RATING-OPTS-INV-2 | Non scrive voti (sola lettura). | `->group('RATING-OPTS-INV-2')` |

## Effetti collaterali

- Nessuno.

## Errori

- Errori Eloquent/morph se il soggetto non è rateable.

## Non fa

- Non calcola somme/conteggi (`GetSum*` / `GetCount*`).
