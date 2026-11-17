---
title: "Rating Module Documentation"
type: documentation
tags: [module, rating, documentation]
created: 2026-06-05
updated: 2026-11-17
qmd: "rating modulo documentazione scopo voti polimorfici HasRating actions filament phpstan"
---

# Modulo Rating

## Scopo

Permettere a un utente autenticato di **valutare** (voto tipicamente 1–5, commento opzionale) **qualsiasi modello** che implementa `HasRatingContract` / usa il trait `HasRating`, con:

- un voto per coppia (utente, rateable) — update invece di duplicato;
- aggregazioni (media, conteggi) per UI e admin;
- gestione BO via Filament (`XotBaseResource`, mai Resource Filament diretta).

**Perché un modulo dedicato:** il contratto polimorfico e le Actions di dominio devono restare riusabili tra Blog, Product, ecc. senza copiare MorphToMany e regole anti-duplicato.

## Non fare

- Non introdurre `RatingService`: usare Actions in `app/Actions/HasRating/`.
- Non estendere classi Filament crude — solo `XotBase*`.
- Non trattare i file `UPPERCASE.md` come SSoT — vedi [index.md](index.md).

## Navigazione

- **Indice canonico:** [index.md](index.md)
- **PHPStan (modulo):** [phpstan-fixes.md](phpstan-fixes.md)
- **Architettura:** [architecture.md](architecture.md) · [rating-architecture.md](rating-architecture.md)
- **Best practice:** [best-practices.md](best-practices.md)
- **Wiki:** [wiki/index.md](wiki/index.md)

## Qualità

Procedura e saturazione host: [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md).  
Sessione / second brain: [00-start.md](../../../../bashscripts/docs/prompts/00-start.md) · [57-second-brain.md](../../../../bashscripts/docs/prompts/57-second-brain.md).

## Dipendenze tipiche

- [Xot](../Xot/docs/) — basi modello/resource  
- [User](../User/docs/README.md) — autore del voto  

## Standard

- [docs-archive-policy.md](docs-archive-policy.md) — `archive/` non è SSoT  
- Nomi `.md`: kebab-case, senza date (eccezione `README.md`)
