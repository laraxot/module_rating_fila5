<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
---
title: "False Friends – Rating"
type: guide
tags: [false, friends, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "FALSE FRIENDS"
related:
  - "./LICENSE.md"
---

=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
# False Friends – Rating

| Falso Amico | Perché è fuorviante | Soluzione |
|-------------|---------------------|-----------|
| `rating_count` = `reviews_count` | Conta anche rating senza testo | Usa `review_count()` distinto |
| `avg(rating)` = `popularity` | Ignora il numero di voti | Normalizza per numero voti |
| 4.5 ⭐ è "ottimo" | Dipende da scala e contesto | Definisci soglie chiare |
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
| Rating sempre crescente | Non considera il tempo | Usa weighted average |
=======
| Rating sempre crescente | Non considera il tempo | Usa weighted average |
>>>>>>> e8cf105 (Check & fix styling)
=======
| Rating sempre crescente | Non considera il tempo | Usa weighted average |
>>>>>>> 77b9106 (.)
=======
| Rating sempre crescente | Non considera il tempo | Usa weighted average |
>>>>>>> c91c8c3 (.)
