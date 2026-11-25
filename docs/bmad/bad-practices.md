---
title: "Bad Practices – Rating"
type: guide
tags: [bad, practices, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "BAD PRACTICES"
related:
  - "./BEST_PRACTICES.md"
status: superseded
superseded_by: ../bad-practices.md
---

# Bad Practices – Rating

## ❌ Calcolare la media in query N+1
Usa `withAvg()` Eloquent per aggregazioni efficienti.

## ❌ Usare float per star_rating
Genera problemi di UI e formattazione; usa interi 1-5.

## ❌ Consentire rating duplicati senza validazione
Implementa `unique:ratings,user_id,rateable_id`.

## Contenuto fuso da `bad-practices.md`

Documento identico al canonico: [bad-practices.md](bad-practices.md).

Canonico: `laravel/Modules/Rating/docs/bmad/bad-practices.md`. Qui non ci sono istruzioni: seguire il file collegato.
