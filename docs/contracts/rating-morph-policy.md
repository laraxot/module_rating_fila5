---
title: "Contratto — RatingMorphPolicy"
type: policy-contract
contract: "Modules\\Rating\\Models\\Policies\\RatingMorphPolicy"
owner: Rating
updated: 2026-11-24
qmd: "RatingMorphPolicy autorizzazione valutazioni ruoli evaluator hr-manager proprietario matricola"
---

# RatingMorphPolicy

Decide chi può vedere, creare, modificare e cancellare una valutazione (`RatingMorph`), cioè dati personali di valutazione. Contratto non-Action (policy), quindi senza le sei sezioni obbligatorie delle Action: descrive la superficie di autorizzazione. Codice: `app/Models/Policies/RatingMorphPolicy.php:11-102`.

## Invarianti

| ID | Regola | Prova nel codice | Test esistente (senza group) |
|---|---|---|---|
| `RATING-POLICY-INV-1` | `viewAny` e `create` ammettono `super-admin`, `admin`, `hr-manager`, `evaluator`. | righe 16-19, 34-37 | `tests/Unit/RatingPolicyRolesTest.php:91,106,117` |
| `RATING-POLICY-INV-2` | `view` e `update`: sempre `super-admin`, `admin`, `hr-manager`; `evaluator` solo se `user->id === model->user_id`; inoltre chi ha un profilo ed è proprietario del modello valutato. | righe 24-47 | `tests/Unit/RatingPolicyRolesTest.php:74,85,121` |
| `RATING-POLICY-INV-3` | `delete`: `super-admin`, `admin`, oppure l'`evaluator` autore; `hr-manager` e il proprietario del modello valutato non possono. | righe 52-56 | `tests/Unit/RatingPolicyRolesTest.php:134` |
| `RATING-POLICY-INV-4` | `restore` e `forceDelete`: solo `super-admin`. | righe 61-72 | non individuato |
| `RATING-POLICY-INV-5` | Proprietario del modello valutato = `user_id` uguale all'utente oppure `matr` uguale alla matricola del profilo; senza modello valutato non c'è proprietà. | righe 77-101 | `tests/Unit/RatingPolicyRolesTest.php:154,163` |

## Effetti collaterali

Nessuno: la policy legge ruoli, profilo e il modello valutato (`$model->model`).

## Errori

- Nessuna eccezione propria: ritorna `false` quando nessuna condizione è soddisfatta.

## Non fa

- Il proprietario del modello valutato, se ha un profilo, può anche **modificare** la valutazione (INV-2): comportamento corrente, da riesaminare prima di estenderlo.
- Non filtra le query: è un controllo per singola operazione.
- Duplicato: `BaseRatingMorphPolicy` (stesso file con `abstract`) ha lo stesso corpo; questo contract vale per la classe concreta, quella coperta da `RatingPolicyRolesTest.php:23`.
- Marker `@see`/`@contract` assente nel docblock: fuori scope docs.
