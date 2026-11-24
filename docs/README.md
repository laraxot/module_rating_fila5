---
title: "Rating Module Documentation"
type: documentation
<<<<<<< .merge_file_CCi8Bm
tags: [module, documentation]
created: 2026-06-05
updated: 2026-06-05
=======
tags: [module, rating, documentation]
created: 2026-06-05
updated: 2026-11-17
qmd: "rating modulo documentazione scopo voti polimorfici HasRating actions filament phpstan"
>>>>>>> .merge_file_wnJK2d
---

# Modulo Rating

<<<<<<< .merge_file_CCi8Bm
## Overview

Il modulo **Rating** fa parte dell'ecosistema [PROJECT_NAME] platform.

## Scopo

Questo modulo gestisce [DESCRIZIONE SPECIFICA DA COMPLETARE].

## Struttura

```
Rating/
├── app/
│   ├── Models/
│   ├── Filament/
│   └── ...
├── docs/
├── lang/
└── resources/
```

## Dipendenze

- [Xot Base](../../Xot/docs/)
- [User Module](../../User/docs/) (se usa autenticazione)
- [Tenant Module](../../Tenant/docs/) (se multi-tenant)

## Collegamenti

- [Documentazione Root](../../../docs/RATING_MODULE.md)
- [Regole Architecture](../../Xot/docs/architecture/)

## Backlinks

- [Indice Moduli](../README.md)

## TODO

- [ ] Completare descrizione funzionalità
- [ ] Documentare modelli principali
- [ ] Documentare risorse Filament
- [ ] Aggiungere esempi codice

- [Conflict Resolution](conflict-resolution.md)


## Standard Rules & Workflow

- [[BMAD Method](../../../../docs/wiki/concepts/bmad-method.md)]
- [[Context Engineering](../../../../docs/wiki/concepts/context-engineering.md)]
- [[LLM Wiki Governance](../../../../docs/wiki/concepts/llm-wiki-governance.md)]

## Documentation

- [On-Demand Pattern](./ON-DEMAND-PATTERN.md) — Pattern per caricamento efficiente
- [QMD Setup](./QMD-SETUP.md) — Configurazione ricerca locale
- [Performance](./PERFORMANCE-OPTIMIZATION.md) — Metriche e best practice
- [Project Structure](./PROJECT-STRUCTURE.md) — Directory layout
=======
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
>>>>>>> .merge_file_wnJK2d
