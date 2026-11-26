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
`## Alternative scartate`, `## Decisione`, `## Conseguenze`, `## Conferma`. Nome file `NNNN-kebab-case.md`, senza data (la data sta nella frontmatter).

## ADR presenti

- [Contratti model in Models/Contracts](0001-model-contracts-live-in-models-contracts.md) — interfacce vicino ai model.
- [Opzioni e voti nella stessa pivot `rating_morph`](0002-rating-morph-options-and-votes-same-pivot.md) — `user_id` null = opzione, non null = voto (**substantive**).

Policy dati/test: [0013-dati-sacri-migrazioni-e-test](../../../Xot/docs/adr/0013-dati-sacri-migrazioni-e-test.md).

## Stato di copertura

Aggiornato il 2026-11-26: 2 ADR, entrambi con le sei sezioni e la «Conferma» e con una sezione «Stato attuale» perche' il codice contraddice in parte la Decisione. `0000-template.md` e `index.md` non sono decisioni.

| ADR | Conferma automatica oggi | Stato attuale |
|---|---|---|
| 0001 model-contracts-live-in-models-contracts | PHPStan (`RatingContract`); nessuna conferma automatica per la cartella | `HasRatingContract` sta in `Models/Contracts` senza `@phpstan-require-extends Model` (i test lo mockano) |
| 0002 rating-morph-options-and-votes-same-pivot | Group `RATING-VOTES-SUM-INV-1`, `RATING-VOTES-COUNT-INV-1`, `RATING-OPTS-INV-1` (mock, non database) | Il trait crea pivot senza `user_id`: la convenzione non vale per la scrittura dal form; decisione umana aperta |

Le promesse delle Action stanno nei [contratti](../contracts/README.md), non qui.
