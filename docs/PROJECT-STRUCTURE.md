---
title: "Project Structure — Module Rating"
type: documentation
created: 2026-05-11
updated: 2026-05-11
tags: [structure, architecture, module]
---

# Project Structure — Module **Rating**

## Directory Structure

\`\`\`
./laravel/Modules/Rating/docs/
├── wiki/                          # Knowledge base locale (LLM Wiki)
│   ├── index.md                  # Master catalog
│   ├── log.md                    # Activity log
│   ├── concepts/                 # Topic/theme pages
│   ├── entities/                 # Organization/person pages
│   ├── rules/                    # ⚠️ 151+ regole progettuali
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> fd7a600 (.)
=======
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
│   │   ├── 00-index.md          # Indice regole
│   │   ├── 00-TRIGGER_MAP.md    # Trigger map (link a globale)
│   │   └── *.md                 # Regole specifiche modulo
│   ├── skills/                   # Skill progettuali
│   │   ├── index.md
│   │   └── *.md
│   ├── commands/                 # Comandi progettuali
│   │   ├── index.md
│   │   └── *.md
│   ├── memories/                 # Memorie progettuali
│   │   ├── index.md
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> fd7a600 (.)
=======
=======
>>>>>>> laraxot/dev
=======
=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
│   │   ├── 00-INDEX.md          # Indice regole
│   │   ├── 00-TRIGGER_MAP.md    # Trigger map (link a globale)
│   │   └── *.md                 # Regole specifiche modulo
│   ├── skills/                   # Skill progettuali
│   │   ├── INDEX.md
│   │   └── *.md
│   ├── commands/                 # Comandi progettuali
│   │   ├── INDEX.md
│   │   └── *.md
│   ├── memories/                 # Memorie progettuali
│   │   ├── INDEX.md
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> laraxot/dev
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
│   │   └── *.md
│   ├── decisions/                # Architecture decision records
│   └── troubleshooting/          # Bug fixes, error resolutions
├── ON-DEMAND-PATTERN.md          # 🌟 QUESTO FILE — Pattern on-demand
├── QMD-SETUP.md                  # Configurazione QMD
├── PERFORMANCE-OPTIMIZATION.md    # Metriche e best practice
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
├── architecture.md               # (opzionale) Architettura modulo
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
<<<<<<< HEAD
├── architecture.md               # (opzionale) Architettura modulo
=======
├── ARCHITECTURE.md               # (opzionale) Architettura modulo
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
<<<<<<< HEAD
=======
├── ARCHITECTURE.md               # (opzionale) Architettura modulo
>>>>>>> laraxot/dev
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
├── ARCHITECTURE.md               # (opzionale) Architettura modulo
>>>>>>> e8cf105 (Check & fix styling)
=======
├── ARCHITECTURE.md               # (opzionale) Architettura modulo
>>>>>>> 77b9106 (.)
=======
├── ARCHITECTURE.md               # (opzionale) Architettura modulo
>>>>>>> c91c8c3 (.)
└── README.md                     # (opzionale) Overview modulo
\`\`\`

## File Chiave

| File | Purpose |
|------|---------|
| `wiki/index.md` | Catalogo di tutto il sapere del modulo |
| `wiki/log.md` | Storico attività (ingest/query/lint) |
| `wiki/rules/` | Regole + trigger map locale |
| `wiki/concepts/` | Concetti specifici del modulo |
| `ON-DEMAND-PATTERN.md` | **Leggi prima** — pattern da seguire |

## Convenzioni

### Naming

- **Filenames**: lowercase-kebab-case.md
- **Directories**: lowercase
- **Titles**: Title Case

### Frontmatter Schema

\`\`\`yaml
---
title: "Page Title"
type: concept|entity|source|comparison|decision|troubleshooting
sources: []  # Solo per raw sources
confidence: high|medium|low
created: YYYY-MM-DD
updated: YYYY-MM-DD
tags: [tag1, tag2]
related:
  - ../concepts/related.md
---
\`\`\`

### Link Rules

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
- **Interno modulo**: `[[concepts/page]]` o `link`
=======
- **Interno modulo**: `[[concepts/page]]` o `[link](./concepts/page.md)`
>>>>>>> e8cf105 (Check & fix styling)
=======
- **Interno modulo**: `[[concepts/page]]` o `[link](./concepts/page.md)`
>>>>>>> 77b9106 (.)
=======
- **Interno modulo**: `[[concepts/page]]` o `[link](./concepts/page.md)`
>>>>>>> c91c8c3 (.)
- **Modulo altro**: `[[../../OtherModule/docs/wiki/concepts/page]]`
- **Project wiki**: `[Global rule](../../docs/wiki/rules/rule.md)`

## Workflow con On-Demand Pattern

\`\`\`mermaid
graph TD
    A[Task Received] --> B{Has trigger?}
    B -->|Yes| C[Read trigger_map]
    C --> D[Load specific file]
    B -->|No| E[qmd search]
    E --> D
    D --> F[Apply knowledge]
    F --> G[Update wiki/log]
\`\`\`

## Riferimenti Globali

- [Project Wiki Root](../../docs/wiki/)
- [Global Rules](../../docs/wiki/rules/)
- [Global Skills](../../docs/wiki/skills/)
- [Global Commands](../../docs/wiki/commands/)
- [Global Memories](../../docs/wiki/memories/)

## Setup Iniziale (per nuovi moduli)

\`\`\`bash
# 1. Crea struttura wiki
mkdir -p docs/wiki/{rules,skills,commands,memories,concepts,entities,decisions,troubleshooting}

# 2. Crea INDEX files (già creati)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
cp docs/wiki/rules/index.md docs/wiki/rules/
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
<<<<<<< HEAD
cp docs/wiki/rules/index.md docs/wiki/rules/
=======
cp docs/wiki/rules/INDEX.md docs/wiki/rules/
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
<<<<<<< HEAD
=======
cp docs/wiki/rules/INDEX.md docs/wiki/rules/
>>>>>>> laraxot/dev
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
cp docs/wiki/rules/INDEX.md docs/wiki/rules/
>>>>>>> e8cf105 (Check & fix styling)
=======
cp docs/wiki/rules/INDEX.md docs/wiki/rules/
>>>>>>> 77b9106 (.)
=======
cp docs/wiki/rules/INDEX.md docs/wiki/rules/
>>>>>>> c91c8c3 (.)
# ... etc

# 3. Aggiungi a QMD collection (opzionale, già incluso global)
# Il .qmd/index.yml include automaticamente docs/**/wiki/

# 4. Committa
git add docs/
git commit -m "docs: add wiki structure for Rating"
\`\`\`

---
*Pattern: On-Demand | Source: docs/wiki/*
