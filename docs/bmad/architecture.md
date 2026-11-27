---
title: "Rating: architettura (verificata sul codice)"
type: architecture
status: active
updated: 2026-11-16
module: Rating
tags: [rating, architecture, morph]
qmd: "architettura Rating rating_morph HasRatingsTrait HasRatingContract connection rating policy Filament"
---

# Rating: architettura

Scopo e rischi: [purpose.md](./purpose.md). Finding: [audits/rating-audit.md](./audits/rating-audit.md).

## Struttura misurata (2026-11-16)

| Cartella `app/` | Contenuto |
|---|---|
| `Models/` | `BaseRating`, `BaseRatingMorph`, `BaseMorphPivot`, `Like`, `AbstractRatingsHost`; connessione `rating` ([BaseModel.php:14](../../app/Models/BaseModel.php)) |
| `Models/Traits/` | `HasRatingsTrait` (770 righe, il contratto reale), `HasLikes`; `RatingTrait` e `HasRating` sono senza consumer |
| `Models/Contracts/` | `HasRatingContract` (`ratings(): MorphToMany`), `RatingContract` |
| `Models/Policies/` | `Base*` + concrete per `Rating` e `RatingMorph` |
| `Actions/HasRating/` | 3 Action di conteggio/somma/opzioni per modello |
| `Filament/` | 4 Resource (`BaseRatingResource`, `BaseRatingMorphResource` + le concrete) più `HasRatingResource/` (RelationManager e Widget), 2 Widget, Block, Concerns (`DecoratesRatingFormFields`) |
| `Datas/` | `RatingData`, `RatingMorphData`, `RatingConfigData`, `RatingBlockData` |

## Flusso

1. Un modello di un altro modulo dichiara `HasRatingContract` e usa `HasRatingsTrait`.
2. La relazione `ratings()` passa da `rating_morph` (`model_type`/`model_id`, `rating_id`, `user_id`, `percentage`).
3. Le Action in `Actions/HasRating/` aggregano; i widget le mostrano.

## Confini

- Dipende solo da Xot (63 import) e Media (1): **non importa nessun modulo di dominio**. Sono gli altri a importare Rating.
- Nessuna route e nessun controller (`routes/*.php` vuoti): modulo solo Filament + trait.

## Punto debole noto

`rating_morph` non ha FK/unique/morphMap (RAT-P1-01) e lo schema è creato da 3+3 migration (RAT-P1-02). Qualsiasi estensione dello schema passa da una migration nuova e additiva.
