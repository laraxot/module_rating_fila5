---
title: "INDEX"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "INDEX"
issues: []
discussions: []
<<<<<<< .merge_file_VYIoes
---

# Rating Module — Documentation Index

**Last updated:** 2026-07-28  
**Stats:** 151 files | 18 categories | 16+ indexed resources

This module's docs are organized under `laravel/Modules/Rating/docs/`.

---

title: "INDEX"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "INDEX"
issues: []
discussions: []
=======
status: stale
---

> Nota 2026-10-14 (docs-audit): Statistiche ferme a luglio ('151 files | 18 categories'): oggi la cartella ha 588 file .md. Indice canonico: 00-INDEX.md (aggiornato 2026-10-14). Contenuto non riscritto, verificare prima di usarlo.

# Rating Module — Documentation Index

**Last updated:** 2026-07-28  
**Stats:** 151 files | 18 categories | 16+ indexed resources

This module's docs are organized under `laravel/Modules/Rating/docs/`.

---
>>>>>>> .merge_file_wUCHKC
## ⚠️ Architectural Rules

- **[No Http Controllers — Folio + Actions + Filament](../../../../docs/wiki/rules/no-controllers-rule.md)** — Absolute rule: Rating module must NOT use Http\Controllers. Rating HTTP endpoints use Folio + Actions. Admin uses Filament.

## Core Design & Architecture

- **Reorderable Table Pattern** (HasXotTable): see IndennitaResponsabilita module docs for the core design; Rating adoption story: `docs/stories/5.96-rating-resource-reordering-adoption.story.md`

## Module-specific Docs

- `docs/stories/5.96-rating-resource-reordering-adoption.story.md` — QA + verification for reordering in RatingResource

## Second Brain References

- Project wiki rules: `docs/wiki/rules/`
- BMAD stories: `docs/bmad/stories/`
- Architecture decisions: `docs/architecture-decisions/` (root)
- Sprint status: `docs/sprint-status.yaml`
