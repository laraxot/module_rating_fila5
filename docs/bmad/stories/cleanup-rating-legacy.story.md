---
title: "Story: Cleanup Rating Module"
qmd: "rating bmad stories cleanup rating story md"
type: note
tags: [documentation]
superseded_by: cleanup-rating.story.md
---
# Story: Cleanup Rating Module

## Context and Problem Statement

Problema e obiettivo sono descritti nel Decision Outcome (migrazione automatica a MADR).

## Decision Drivers

- Richiesta utente / acceptance criteria della story
- Vincoli BMAD, second brain, Pest gate e dati sacri

## Considered Options

- Status quo (non fare)
- Implementare come descritto nel Decision Outcome

## Decision Outcome

Scelta: **implementare**, perché i driver sopra.

## BMAD Method Applied
- **Scale**: Feature/module (Rating)
- **Impact**: Rating system, RatingResource, RatingPolicy, RatingFilter
- **Quality Gates**: PHPStan, Pint, Rating-specific quality checks

## Tasks
1. **Understand** — Review Rating module structure, RatingResource, RatingPolicy
2. **Plan** — Identify duplicate Rating files, optimize Rating table, fix PHPStan issues
3. **Implement** — Clean up Rating artifacts, fix table column names, remove dead code
4. **Verify** — Run `phpstan analyse Modules/Rating`, `pint`, `phpmd`
5. **Document** — Update sprint-status.yaml, add to docs/bmad-stories

## References
- Rating/docs/architecture.md
- Rating/docs/INDEX.md
- Rating/Comments and reviews handling


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
