---
title: "STORY — governance ADR e contratti (harness laravelday)"
type: story
status: done
date: 2026-11-26
owner: Rating
related:
  - ../adr/0002-rating-morph-options-and-votes-same-pivot.md
  - ../../../Xot/docs/stories/0042-laravel-day-harness-adoption.story.md
  - ../../../Xot/docs/adr/0012-behavioral-contract-governance.md
---

# Governance ADR e contratti (harness laravelday)

## Obiettivo

Adottare il pattern workshop laravelday **a livello di package owner**: almeno un ADR substantive
(Contesto, Driver, Alternative, Decisione, Conseguenze, Conferma) e contratti locali, senza un secondo
workflow agente. Xot resta owner delle regole trasversali.

## Stato

- [x] ADR substantive owner: [rating_morph opzioni/voti](../adr/0002-rating-morph-options-and-votes-same-pivot.md)
- [x] Indice `docs/adr/README.md` aggiornato con link relativi
- [x] Gate `PackagesHaveContractsAndAdrTest` verde (substantive ADR + sezioni minime)

## Criteri di accettazione

- ≥1 ADR del package con tutte le sezioni substantive.
- Nessun nome file con date; docs solo nelle cartelle `docs/` esistenti.
- Nessun commit richiesto da questa story.
