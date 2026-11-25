---
title: "Best practices: Rating"
type: guide
tags: [best-practices, rating]
created: 2026-07-14
updated: 2026-09-02
qmd: "best practices rating"
related:
  - "./false-friends.md"
superseded_by: ../best-practices.md
---

# Best practices: Rating

## Nota 2026-09-02

Questo file e `BEST_PRACTICES.md` (gemello con collisione di case, cancellato)
contenevano contenuti opposti e inconciliabili: uno rimandava a un canonical
`Themes/docs/shared-components/.gitkeep-Modules` che è un file placeholder
vuoto, l'altro descriveva classi (`RatingService`, `RatingStar`,
`AverageRating`) che **non esistono** in questo modulo (verificato con
`grep -rln "class RatingService\|class RatingStar\|class AverageRating" app`
- zero risultati). Nessuno dei due era utilizzabile: il primo puntava al
nulla, il secondo era inventato.

## Modelli reali del dominio (verificato)

`app/Models/`: `Rating`, `BaseRating`, `RatingMorph`, `BaseRatingMorph`,
`Like`, `AbstractRatingsHost`. Azioni sotto `app/Actions/HasRating/`.

Una guida best-practices accurata richiede di documentare questi, non le
classi immaginarie di prima: non scritta qui per non ripetere lo stesso
errore (contenuto plausibile ma non verificato riga per riga sul codice).

## Contenuto fuso da `best-practices.md`

# Best Practices – Rating

## Principi DRY/KISS
- **DRY**: Centralizza logica di scoring in `RatingService`. Usa attributi calcolati per azioni utente.
- **KISS**: Usa `star_rating` come integer 1-5, non float o stringhe.
- **Clean Code**: Segui il pattern `Builder` per recensioni complesse.

## Componenti
- Usa `RatingStar` per visualizzare icone vuote/piene.
- Usa `AverageRating` come campo calcolato (non memorizzato).

## Test
- Implementa test unitari per `RatingService::calculate()`.
- Copri casi limite come rating inversi.

## Documentazione
- Aggiorna `docs/index.md` con nuovi endpoint.
- Collega a moduli correlati come `Review` e `Auth`.
