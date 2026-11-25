---
tags: [documentation]
created: 2026-09-26
qmd: "rating data export methods.story"
issues: []
discussions: []
title: "rating-data-export-methods"
type: story
module: Rating
status: superseded
story_id: "rating-data-export-methods"
updated: 2026-09-23
superseded_by: ./5.238-rating-export-early-stories-supersede.story.md
---
# Story: rating-data-export-methods (storico)

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
**Epic**: utility rating riutilizzabili per export XLS

## AC (storici: soddisfatti altrove)
- [x] `formFieldLabel` / path in `RatingData` (consolidation)
- [x] `RatingData::getXlsFields` usa i metodi (5.229 / move)
- [x] Callers ripuntati (5.231)



### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
