<<<<<<< .merge_file_0defsb
=======
---
title: "Bad Practices – Rating"
type: note
status: draft
updated: 2026-10-07
tags: [docs, rating, wiki]
qmd: "bad practices   rating rating"
---
>>>>>>> .merge_file_kUKNwN
# Bad Practices – Rating

## ❌ Calcolare la media in query N+1
Usa `withAvg()` Eloquent per aggregazioni efficienti.

## ❌ Usare float per star_rating
Genera problemi di UI e formattazione; usa interi 1-5.

## ❌ Consentire rating duplicati senza validazione
Implementa `unique:ratings,user_id,rateable_id`.
