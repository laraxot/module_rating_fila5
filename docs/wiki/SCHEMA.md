---
title: Wiki Schema
description: Schema e convenzioni per la manutenzione della wiki
tags:
  - schema
  - conventions
  - llm-instructions
created: 2026-04-15
---

# Wiki Schema - Rating

Istruzioni per l'LLM su come mantenere questa wiki.

## Struttura

```
docs/
├── wiki/
│   ├── index.md           # Catalogo
│   ├── log.md             # Registro
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
│   ├── schema.md          # Questo file
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
<<<<<<< HEAD
│   ├── schema.md          # Questo file
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
<<<<<<< HEAD
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> laraxot/dev
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> e8cf105 (Check & fix styling)
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> 77b9106 (.)
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> c91c8c3 (.)
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> 2025498 (.)
│   ├── concepts/          # Pattern, architettura
│   ├── entities/          # Modelli, azioni
│   ├── sources/           # Doc esterna
│   └── comparisons/       # Tabelle comparative
└── raw/                   # Sorgenti immutable
```

## Convenzioni

- File: kebab-case (es. `entity-user.md`)
- Frontmatter: title, description, tags, created
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
- Cross-ref: `Link`
=======
- Cross-ref: `[Link](../concepts/name.md)`
>>>>>>> e8cf105 (Check & fix styling)
=======
- Cross-ref: `[Link](../concepts/name.md)`
>>>>>>> 77b9106 (.)
=======
- Cross-ref: `[Link](../concepts/name.md)`
>>>>>>> c91c8c3 (.)
=======
- Cross-ref: `[Link](../concepts/name.md)`
>>>>>>> 2025498 (.)
- NON modificare mai `docs/raw/`
