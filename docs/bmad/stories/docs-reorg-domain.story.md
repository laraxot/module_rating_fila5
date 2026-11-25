---
title: "Story: Indice docs canonico Rating"
type: story
module: Rating
tags: [docs, bmad, rating, reorganization]
qmd: rating docs reorg domain story
status: draft
updated: 2026-10-09
---
# Story: Indice docs canonico Rating

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

**Data:** 2026-10-09 · **Stato:** review

## Obiettivo

Chiarire l’ingresso canonico alla documentazione BMAD e mantenere il patrimonio esistente.

## Audit e risultato

- `bmad/index.md` esistente e già più completo di `INDEX.md`: aggiornato con la navigazione comune.
- Nessun marker di merge rilevato sotto `docs/`.
- Varianti case-sensitive non eliminate.

## Acceptance criteria

- [x] Indice aggiornato.
- [x] Story locale creata.
- [x] Nessun contenuto spostato o cancellato.
- [x] Audit marker eseguito.


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
