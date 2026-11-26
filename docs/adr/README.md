---
title: "ADR — Rating"
type: index
owner: Rating
updated: 2026-11-26
qmd: "Rating ADR architecture decision record MADR formato valutazioni polimorfiche"
---

# ADR — Rating

Un ADR del modulo Rating registra una scelta difficile da invertire sulle valutazioni polimorfiche.
Template: [0000-template](0000-template.md). Standard trasversale: [Xot ADR](../../../Xot/docs/adr/README.md).

## Formato

Sezioni substantive (workshop laravelday / MADR FixCity): `## Contesto`, `## Driver della decisione`,
`## Alternative scartate`, `## Decisione`, `## Conseguenze`, `## Conferma`. Nome file kebab-case senza data.

## ADR presenti

- [Contratti model in Models/Contracts](0001-model-contracts-live-in-models-contracts.md) — interfacce vicino ai model.
- [Opzioni e voti nella stessa pivot `rating_morph`](0002-rating-morph-options-and-votes-same-pivot.md) — `user_id` null = opzione, non null = voto (**substantive**).

Policy dati/test: [0013-dati-sacri-migrazioni-e-test](../../../Xot/docs/adr/0013-dati-sacri-migrazioni-e-test.md).
