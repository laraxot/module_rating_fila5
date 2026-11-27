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

**Quando leggerli**: prima di scrivere una query su `rating_morph` o su `ratings()`, di aggiungere un aggregato (somme,
conteggi, percentuali) o un'interfaccia nuova.

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

## Harness minimo: ownership, evidenza e recupero (2026-11-27)

Questo indice appartiene a **module_rating_fila5**: ogni decisione su codice, dominio o tema va nell'ADR del package owner; il root registra soltanto i vincoli di composizione. Un ADR richiede una scelta reale con alternative e conseguenze, più una **Conferma** ripetibile (oppure la dichiarazione esplicita che manca). Non creare ADR fittizi per riempire un indice.

- [Confine LaravelDay/harness Xot](https://github.com/laraxot/module_xot_fila5/blob/dev/docs/adr/0042-laravel-day-harness-adoption-boundary.md); [ownership root](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/adr/0001-harness-minimo-e-ownership.md).
- **BMAD**: la story owner-local conserva `scope`, `must_not_change`, `evidence`, `approval_required` nei cambi rischiosi.
- **ECC**: nessun marker di merge; distinguere la prova eseguita dal semplice riferimento a un test; se la conferma non è disponibile segnare `non eseguita`.
- **Second Brain**: QMD/Graphify e `.harness/memory/{facts,lessons}.md` sono puntatori a evidenza datata, non copie degli ADR. [Runbook](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/harness/README.md) · [Rollout #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
