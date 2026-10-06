---
title: "Rating — scopo del modulo e come raggiungerlo meglio"
type: concept
status: active
created: 2026-10-06
tags: [rating, purpose, criteri, valutazione, polimorfici, morph]
qmd: "rating scopo modulo criteri valutazione polimorfici morphs rating_morph hasratings"
updated: 2026-10-06
issues:
  - "https://github.com/laraxot/module_rating_fila5/issues/"
discussions:
  - "https://github.com/laraxot/module_rating_fila5/discussions/"
---

# Rating — perche' esiste

## Lo scopo in una frase

**Rating fornisce un sistema polimorfico di criteri di valutazione condiviso fra moduli diversi (schede, indennitá, progressioni) tramite `HasRatingsTrait`: ogni scheda raccoglie punteggi e note secondo un criterio diverso, senza duplicare il codice.**

## L'evidenza

- `RatingMorphTrait`, `HasRatingsTrait`: relazione polimorfca su `ratings` e `rating_morph`
- 34 Action, 15 Widget, 412 file di documentazione
- Ogni modulo che valuta (Performance, Progressioni, IndennitaResponsabilita) usa Rating tramite trait

## Confini — cosa **non** appartiene a Rating

- Il **calcolo della performance**: dominio di Performance
- La **valutazione della progressione**: dominio di Progressioni
- Le **classi base Filament**: Xot

## Collegamenti

- `docs/wiki/rules/` — convenzioni e pattern
- `docs/bmad/` — lavoro in corso
