---
title: "Contratti — Rating"
type: index
owner: Rating
tags: [contracts, actions, rating, pivot]
created: 2026-11-18
updated: 2026-11-26
qmd: "Rating contract comportamentali valutazioni dati personali policy aggregazioni invarianti RATING-INV"
---

# Contratti — Rating

Un contratto descrive un'operazione di Rating che tocca valutazioni (dati personali di performance) o ne regola l'accesso. Documenta il comportamento **implementato**, difetti compresi (sezione «Limiti noti»).
Standard: [contract-authoring-standard](../../../Xot/docs/contracts/contract-authoring-standard.md); governance: [ADR 0012](../../../Xot/docs/adr/0012-behavioral-contract-governance.md); regola: [action-behavioral-contract](../../../Xot/docs/rules/action-behavioral-contract.md).

Leggili prima di toccare le Action di aggregazione, la scrittura dei voti nel trait `HasRatingsTrait` o la convenzione `user_id` nullo = opzione dell'[ADR 0002](../adr/0002-rating-morph-options-and-votes-same-pivot.md).
Provare una promessa: `cd laravel && vendor/bin/pest Modules/Rating/tests --group=<ID>`. Registro dei file: [index.md](index.md), inventario: [INDEX.md](INDEX.md).

## Formato

Per le Action: frontmatter `type: contract` e `action: "Modules\\Rating\\Actions\\..."`, sezioni `## Input`, `## Output`, `## Invarianti` (tabella `ID | Regola | Group Pest`), `## Effetti collaterali`, `## Errori`, `## Non fa`, poi `## Limiti noti`.
ID `RATING-<AREA>-INV-<N>`, stabili: non si rinominano e non si rinumerano (i gruppi dei test li citano).

## Contratti

- [get-sum-by-model-rating-id-action](get-sum-by-model-rating-id-action.md) — somma dei voti, solo `user_id` non nullo (`RATING-VOTES-SUM-INV-1..4`).
- [get-count-by-model-rating-id-action](get-count-by-model-rating-id-action.md) — conteggio dei voti (`RATING-VOTES-COUNT-INV-1..3`); conta i valori non nulli.
- [get-rating-opts-by-model-action](get-rating-opts-by-model-action.md) — opzioni del model, solo `user_id` nullo (`RATING-OPTS-INV-1..3`).
- [has-ratings-trait](has-ratings-trait.md) — scrittura dei voti sulla pivot: `syncRatingsFormData`, `clearEvaluation` (`RATING-WRITE-INV-1..8`).

## Stato di copertura

Aggiornato il 2026-11-26. 4 contratti, 18 invarianti, **16 dimostrate** da un test con group, 2 promesse dal codice ma non dimostrate.

| Contratto | Invarianti | Dimostrate |
|---|---|---|
| GetSumByModelRatingIdAction | 4 | 4 |
| GetCountByModelRatingIdAction | 3 | 3 |
| GetRatingOptsByModelAction | 3 | 2 (manca INV-3, chiavi intere e titolo non stringa) |
| HasRatingsTrait (scrittura) | 8 | 7 (manca INV-4, `LogicException`) |

Tutte le prove sono con mock (`Mockery::mock(MorphToMany::class)` nelle Action, `forcedHasMany`/`forcedMorph` negli stub del trait): provano quali chiamate fa il codice, non il risultato su un database.
«Dimostrata» vuol dire cio': un test sul database delle regole (somma, conteggio, scrittura) non esiste ancora.

## Backlog contract

Action e punti di scrittura senza contratto (lo script di audit non ne conta altre: ogni Action di `app/Actions/` ha il suo):

| Elemento | Perche' |
|---|---|
| `RatingMorphPolicy` e `RatingPolicy` | Autorizzano l'accesso a dati personali di valutazione; il formato `policy-contract` e' previsto dallo standard ma non c'e' ancora un file (`tests/Unit/RatingPolicyTest.php`, `RatingPolicyRolesTest.php` esistono). |
| `HasLikes` (`app/Models/Traits/HasLikes.php`) | Scrive `likes` per utente (righe 28, 42): ha `tests/Unit/HasLikesTraitTest.php`, nessun contratto. |
| `HasRating::getBettingUsers()`, `getVolumeCredit()`, `getRatingsPercentageByUser()` | Leggono `RatingMorph` per `model_id` senza `model_type`: debito dell'ADR 0002, non un contratto. |

## Backlog test

| ID | Cosa servirebbe |
|---|---|
| RATING-OPTS-INV-3 | Un'opzione con titolo `null` e un id passato come stringa: l'Action restituisce `null` e chiave intera (oggi il mock restituisce gia' i tipi giusti). |
| RATING-WRITE-INV-4 | `syncRatingsFormData` e `clearEvaluation` su un host non salvato: `expect(...)->toThrow(LogicException::class)`. |
| Tutti | Un test con database vero (sqlite) che crei opzioni e voti e provi somma, conteggio e scrittura; oggi nessuna prova passa da `rating_morph` reale. Vedi anche il limite sul `user_id` mancante in [has-ratings-trait](has-ratings-trait.md). |

## Harness minimo: ownership, evidenza e recupero (2026-11-27)

I contratti di **module_rating_fila5** restano accanto alle Action, interfacce o superfici di questo package; root e Xot definiscono lo standard, non copiano le promesse. Un contratto comportamentale esplicita **Input, Output, Invarianti, Effetti collaterali, Errori, Non fa**; ogni ID di invariante punta a un group Pest effettivo oppure segnala `non dimostrata`. Se esiste la classe, il docblock deve rimandare al file con `@contract` e `@see`; per temi senza classi PHP non inventare Action/contratti.

- [Standard Xot](https://github.com/laraxot/module_xot_fila5/blob/dev/docs/contracts/contract-authoring-standard.md) · [ownership root](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/adr/0001-harness-minimo-e-ownership.md) · [runbook ECC/Second Brain](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/harness/README.md).
- **BMAD**: prima di cambiare una promessa, fissa nella story owner scope, esclusioni, evidenza e approvazioni richieste.
- **ECC**: i marker di merge rendono invalido l'indice; citare una suite non significa averla eseguita. Distingui `pass`, `fail`, `non eseguito` e registra il debito in [rollout #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
