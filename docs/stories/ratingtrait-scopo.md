---
title: "ratingtrait scopo"
qmd: "rating stories ratingtrait scopo md"
type: note
tags: [documentation]
---
# Story

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

Scopo: RatingTrait è un trait riutilizzabile per logica rating. trait.unused = non usato da nessun modello attualmente, ma disponibile per riuso futuro.
Scopo: RatingTrait fornisce metodi riutilizzabili per logica rating (calcolo punteggio, rapporto, valutazione). Non usato attualmente da alcun modello.


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
