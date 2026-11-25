---
tags: [documentation]
created: 2026-09-26
qmd: "rating export fields reusable.story"
issues: []
discussions: []
title: "rating export fields reusable"
type: story
module: Rating
status: superseded
story_id: "rating-export-fields-reusable"
updated: 2026-09-23
superseded_by: ./5.238-rating-export-early-stories-supersede.story.md
---
# Story: rating export fields reusable (storico)

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

**Status**: superseded
**Modulo**: Rating


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
