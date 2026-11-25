---
title: "False Friends – Rating"
type: guide
tags: [false, friends, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "FALSE FRIENDS"
related:
  - "license.md"
status: superseded
superseded_by: ../false-friends.md
---

# False Friends – Rating

| Falso Amico | Perché è fuorviante | Soluzione |
|-------------|---------------------|-----------|
| `rating_count` = `reviews_count` | Conta anche rating senza testo | Usa `review_count()` distinto |
| `avg(rating)` = `popularity` | Ignora il numero di voti | Normalizza per numero voti |
| 4.5 ⭐ è "ottimo" | Dipende da scala e contesto | Definisci soglie chiare |
| Rating sempre crescente | Non considera il tempo | Usa weighted average |

## Contenuto fuso da `false-friends.md`

Documento identico al canonico: [false-friends.md](false-friends.md).

Canonico: `laravel/Modules/Rating/docs/bmad/false-friends.md`. Qui non ci sono istruzioni: seguire il file collegato.
