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
│   ├── SCHEMA.md          # Questo file
=======
<<<<<<< HEAD
<<<<<<<< HEAD:docs/wiki/schema.md
│   ├── schema.md          # Questo file
========
=======
>>>>>>> laraxot/dev
<<<<<<< HEAD
=======
>>>>>>> b2d53b8 (.)
│   ├── schema.md          # Questo file
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> laraxot/dev
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>>> laraxot/dev:docs/wiki/SCHEMA.md
=======
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
=======
>>>>>>> b2d53b8 (.)
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
- Cross-ref: `[Link](../concepts/name.md)`
=======
- Cross-ref: `Link`
>>>>>>> laraxot/dev
=======
- Cross-ref: `Link`
>>>>>>> b2d53b8 (.)
- NON modificare mai `docs/raw/`
