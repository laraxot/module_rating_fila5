<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
---
title: "Best Practices – Rating"
type: guide
tags: [best, practices, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "BEST PRACTICES"
related:
  - "./FALSE_FRIENDS.md"
---

=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
- Aggiorna `docs/index.md` con nuovi endpoint.
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
<<<<<<< HEAD
- Aggiorna `docs/index.md` con nuovi endpoint.
=======
- Aggiorna `docs/INDEX.md` con nuovi endpoint.
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
<<<<<<< HEAD
=======
- Aggiorna `docs/INDEX.md` con nuovi endpoint.
>>>>>>> laraxot/dev
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
- Collega a moduli correlati come `Review` e `Auth`.
=======
- Aggiorna `docs/INDEX.md` con nuovi endpoint.
- Collega a moduli correlati come `Review` e `Auth`.
>>>>>>> e8cf105 (Check & fix styling)
=======
- Aggiorna `docs/INDEX.md` con nuovi endpoint.
- Collega a moduli correlati come `Review` e `Auth`.
>>>>>>> 77b9106 (.)
=======
- Aggiorna `docs/INDEX.md` con nuovi endpoint.
- Collega a moduli correlati come `Review` e `Auth`.
>>>>>>> c91c8c3 (.)
