---
title: "Contratti — Rating"
type: index
tags: [contracts, actions, rating]
created: 2026-11-18
updated: 2026-11-24
---

# Contratti — Rating

Le Action di Rating sono letture, ma portano la regola che più facilmente si rompe: separare i **voti** (pivot con
`user_id`) dalle **opzioni** (pivot senza `user_id`). I contratti dicono quale delle due righe ogni Action legge.
Le interfacce in `app/Contracts` e `app/Models/Contracts` sono documentate nei loro docblock e in
`../dove-vive-un-contratto.md`.

**Quando leggerli**: prima di usare questi aggregati in un widget o in un export, o di scriverne uno nuovo.

Formato (6 sezioni, tabella invarianti con ID e group Pest, `@contract` nel docblock):
[action-behavioral-contract](../../../Xot/docs/rules/action-behavioral-contract.md). Un'invariante con group si
verifica con `vendor/bin/pest Modules/Rating/tests --group=<ID>`; `—` è debito dichiarato.

## Contratti

- [GetSumByModelRatingIdAction](get-sum-by-model-rating-id-action.md) — somma dei `value` dei voti di un model, per criterio o totale.
- [GetCountByModelRatingIdAction](get-count-by-model-rating-id-action.md) — numero dei voti di un model, per criterio o totale.
- [GetRatingOptsByModelAction](get-rating-opts-by-model-action.md) — i criteri attivi su un model, id → titolo.
