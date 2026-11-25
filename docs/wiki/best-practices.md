---
title: "Best practices: Rating"
type: alias
status: superseded
canonical: "bmad/best-practices.md"
qmd: "best-practices alias superseded"
---

# Best practices: Rating

Documento identico al canonico: [best-practices.md](../bmad/best-practices.md).

Canonico: `laravel/Modules/Rating/docs/bmad/best-practices.md`. Qui non ci sono istruzioni: seguire il file collegato.

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
