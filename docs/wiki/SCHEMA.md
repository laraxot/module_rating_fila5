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
<<<<<<< .merge_file_VEGcaF
│   ├── schema.md          # Questo file
=======
<<<<<<< HEAD
│   ├── schema.md          # Questo file
=======
│   ├── SCHEMA.md          # Questo file
>>>>>>> laraxot/dev
>>>>>>> .merge_file_kvZppw
│   ├── concepts/          # Pattern, architettura
│   ├── entities/          # Modelli, azioni
│   ├── sources/           # Doc esterna
│   └── comparisons/       # Tabelle comparative
└── raw/                   # Sorgenti immutable
```

## Convenzioni

- File: kebab-case (es. `entity-user.md`)
- Frontmatter: title, description, tags, created
- Cross-ref: `Link`
- NON modificare mai `docs/raw/`
