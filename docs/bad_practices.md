---
title: "bad practices"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "bad practices"
issues: []
discussions: []
<<<<<<< .merge_file_HT8oeW
=======
status: draft
>>>>>>> .merge_file_At8OEL
---

# Bad Practices – Rating

## ❌ Calcolare la media in query N+1
Usa `withAvg()` Eloquent per aggregazioni efficienti.

## ❌ Usare float per star_rating
Genera problemi di UI e formattazione; usa interi 1-5.

## ❌ Consentire rating duplicati senza validazione
Implementa `unique:ratings,user_id,rateable_id`.
