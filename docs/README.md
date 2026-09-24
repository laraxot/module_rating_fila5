---
<<<<<<< HEAD
<<<<<<< HEAD
title: "Rating Module"
type: documentation
module: Rating
updated: 2026-09-16
---

# Rating Module

Sistema di criteri di valutazione polimorfici (`ratings` / `rating_morph`) usato dalle schede HR
(Performance, IndennitaResponsabilita, ecc.) via `HasRatingsTrait`.

## Navigazione docs

| Area | Path |
|------|------|
| **BMAD attivo** (Select «altro» + note) | [bmad/README.md](bmad/README.md) |
| Architecture / index generici | [architecture.md](architecture.md) · [index.md](index.md) |
| Design Select+Textarea | [stories/rating-altro-option-conditional-textarea-design.story.md](stories/rating-altro-option-conditional-textarea-design.story.md) |
| Criteri a scelta | [criteri-a-scelta-multipla.md](criteri-a-scelta-multipla.md) |

## Canon UI (2026-09-16) — una riga

Con figli: **Select + Textarea** sempre; option «altro» = `''`; placeholder = `null`;
`note` required solo se `selectIsOther === ''`. Dettaglio: [bmad/](bmad/README.md).

## GitHub (pack attuale)

- Design: https://github.com/laraxot/module_rating_fila5/issues/57
- Impl: https://github.com/laraxot/module_rating_fila5/issues/58
- Discussion: https://github.com/laraxot/module_rating_fila5/discussions/59
- D-8 filtro: https://github.com/laraxot/module_rating_fila5/issues/60

## Nota conflitti docs

Questo README aveva marker di merge non risolti (`<<<<<<< HEAD`); ripulito 2026-09-16.
Preferire sempre `docs/bmad/` per lavoro in corso; bozze in `docs/stories/` con
`ALTRO_KEY='altro'` sono superseded-pointer.
=======
=======
>>>>>>> 77b9106 (.)
title: "Rating Module Documentation"
type: documentation
tags: [module, documentation]
created: 2026-06-05
updated: 2026-06-05
---

# Modulo Rating

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

- [Xot Base](../Xot/docs/)
- [User Module](../User/docs/) (se usa autenticazione)
- [Tenant Module](../Tenant/docs/) (se multi-tenant)

## Collegamenti

- [Documentazione Root](../../../docs/RATING_MODULE.md)
- [Regole Architecture](../Xot/docs/architecture/)

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
<<<<<<< HEAD
- [Project Structure](./PROJECT-STRUCTURE.md) — Directory layout
>>>>>>> e8cf105 (Check & fix styling)
=======
- [Project Structure](./PROJECT-STRUCTURE.md) — Directory layout
>>>>>>> 77b9106 (.)
