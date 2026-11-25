---
qmd: "rating stories rating docs graphify tracked story md"
id: rating-docs-graphify-tracked
title: "Rimuovere docs/graphify tracciato in Rating"
type: story
status: open
priority: P3
owner: module:Rating
module: Rating
tags: [git, igiene, graphify]
related: [lang-docs-graphify-tracked]
---
# Rimuovere docs/graphify tracciato in Rating

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

Fase BMAD: Dev.

## Stato
`docs/graphify` è output generato, tracciato nel modulo Rating. Lo stesso vale per Lang e Notify.

## Azioni
1. Verificare che nessun riferimento nel codice o nelle docs punti a `docs/graphify`.
2. Aggiungere la cartella a `.gitignore` e rimuoverla dal tracciamento in un commit separato.

## Verifica
- `ModuleRootHygieneTest` verde per Rating.


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

- `ModuleRootHygieneTest` verde per Rating.
