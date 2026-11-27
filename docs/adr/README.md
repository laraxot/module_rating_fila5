---
title: "ADR — Rating"
type: index
<<<<<<< .merge_file_XZ3ADg
tags: [adr, decisioni, rating]
created: 2026-11-18
updated: 2026-11-24
=======
owner: Rating
updated: 2026-11-26
qmd: "Rating ADR architecture decision record MADR formato valutazioni polimorfiche"
>>>>>>> .merge_file_sGCCCv
---

# ADR — Rating

<<<<<<< .merge_file_XZ3ADg
Rating è consumato da più moduli, ognuno con la propria classe concreta e spesso su una connessione diversa: le sue
decisioni riguardano **cosa significa una riga della pivot `rating_morph`** e **dove vivono le interfacce** che i
moduli consumatori implementano.
=======
Un ADR del modulo Rating registra una scelta difficile da invertire sulle valutazioni polimorfiche.
Template: [0000-template](0000-template.md). Standard trasversale: [Xot ADR](../../../Xot/docs/adr/README.md).
>>>>>>> .merge_file_sGCCCv

**Quando leggerli**: prima di scrivere una query su `rating_morph` o su `ratings()`, di aggiungere un aggregato (somme,
conteggi, percentuali) o un'interfaccia nuova.

<<<<<<< .merge_file_XZ3ADg
Formato e regole: [action-behavioral-contract](../../../Xot/docs/rules/action-behavioral-contract.md) (5 sezioni,
`## Verifica` obbligatoria, nome = argomento senza date).
=======
Sezioni substantive (workshop laravelday / MADR FixCity): `## Contesto`, `## Driver della decisione`,
`## Alternative scartate`, `## Decisione`, `## Conseguenze`, `## Conferma`. Nome file `NNNN-kebab-case.md`, senza data (la data sta nella frontmatter).

## ADR presenti

- [Contratti model in Models/Contracts](0001-model-contracts-live-in-models-contracts.md) — interfacce vicino ai model.
- [Opzioni e voti nella stessa pivot `rating_morph`](0002-rating-morph-options-and-votes-same-pivot.md) — `user_id` null = opzione, non null = voto (**substantive**).

Policy dati/test: [0013-dati-sacri-migrazioni-e-test](../../../Xot/docs/adr/0013-dati-sacri-migrazioni-e-test.md).

## Stato di copertura

Aggiornato il 2026-11-26: 2 ADR, entrambi con le sei sezioni e la «Conferma» e con una sezione «Stato attuale» perche' il codice contraddice in parte la Decisione. `0000-template.md` e `index.md` non sono decisioni.
>>>>>>> .merge_file_sGCCCv

| ADR | Conferma automatica oggi | Stato attuale |
|---|---|---|
| 0001 model-contracts-live-in-models-contracts | PHPStan (`RatingContract`); nessuna conferma automatica per la cartella | `HasRatingContract` sta in `Models/Contracts` senza `@phpstan-require-extends Model` (i test lo mockano) |
| 0002 rating-morph-options-and-votes-same-pivot | Group `RATING-VOTES-SUM-INV-1`, `RATING-VOTES-COUNT-INV-1`, `RATING-OPTS-INV-1` (mock, non database) | Il trait crea pivot senza `user_id`: la convenzione non vale per la scrittura dal form; decisione umana aperta |

<<<<<<< .merge_file_XZ3ADg
- [Opzioni e voti nella stessa pivot](rating-morph-options-and-votes-same-pivot.md) — in `rating_morph` `user_id` nullo = opzione attiva sul model, valorizzato = voto.
- [I contratti dei model stanno in app/Models/Contracts](model-contracts-live-in-models-contracts.md) — un'interfaccia con `@phpstan-require-extends Model` va lì, le altre in `app/Contracts`.
=======
Le promesse delle Action stanno nei [contratti](../contracts/README.md), non qui.
>>>>>>> .merge_file_sGCCCv
