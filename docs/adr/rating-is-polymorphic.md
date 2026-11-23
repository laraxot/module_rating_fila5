---
title: "ADR — Rating polimorfico"
type: decision
status: accepted
created: 2026-11-23
updated: 2026-11-23
issues: []
module: Rating
---

# ADR — Rating polimorfico

## Contesto

Più domini possono ricevere una valutazione senza duplicare il modello di rating.

## Driver della decisione

- Riutilizzare il servizio mantenendo ownership nel dominio consumer.

## Decisione

Rating usa una relazione polimorfica e risolve il modello consumer quando disponibile.

## Alternative scartate

- Creare una tabella e un servizio per ogni dominio.

## Conseguenze

Il modulo è riusabile; policy e moderazione restano responsabilità del dominio owner.

## Conferma

Verificare relazione polimorfica, policy e test di inserimento.
