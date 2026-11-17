---
title: "Rating — best practices"
type: concept
tags: [rating, dry, kiss, has-rating]
updated: 2026-11-17
qmd: "rating best practices HasRating actions morphToMany no RatingService dry kiss"
canonical: true
related:
  - ./index.md
  - ./architecture.md
  - ./phpstan-fixes.md
---

# Rating — best practices

> `BEST_PRACTICES.md` è alias storico (contenuto obsoleto che citava un `RatingService` inesistente). **Questo file è il canonico.**

## Scopo

Voti coerenti, tipizzati e riusabili: un host rateable espone `ratings()` via `HasRating` / `HasRatingContract`; la scrittura passa da Actions, non da service generici.

## DRY / KISS

- **Trait + contratto** sul modello host (`HasRating`), non copia di MorphToMany nei consumer.
- **Actions** in `app/Actions/HasRating/` per lettura/aggregazione (es. opts, sum) — niente `RatingService`.
- Voto come dominio chiaro (enum/cast dove già previsto), non stringhe magiche sparse.
- Un voto per utente+rateable: update, non insert duplicato.

## Filament / Xot

- Resource e colonne: `XotBase*`; traduzioni via Lang, non `->label()` hardcoded.
- Widget admin: riuso pattern modulo, non duplicare StatsOverview in path paralleli (vedi [wiki/redundancy](wiki/redundancy/duplicate-ratings-table-migrations.md)).

## PHPStan

Cause tipiche (generics MorphToMany, Builder, Pest harness): [phpstan-fixes.md](phpstan-fixes.md). Procedura globale: [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md).

## Indice

[index.md](index.md)
