---
title: "Audit BMAD — Rating"
type: audit
status: review
updated: 2026-11-16
module: Rating
qmd: "audit BMAD Rating sintesi rating_morph integrità migration duplicate PHPStan Pest skip"
---

# Audit BMAD — Rating

SSoT dettagliata: [audits/rating-audit.md](./audits/rating-audit.md). Questo file è solo la sintesi.

## Sintesi (2026-11-16)

| Metrica | Valore |
|---|---:|
| PHP `app/` | 76 |
| Test (file PHP / `*Test.php`) | 42 / 30 |
| Resource / Actions / Services / Policy | 4 / 3 / 0 / 4 |
| Migration (radice) | 8 |
| Marker conflitto | 0 |
| P0 / P1 / P2 | 0 / 2 / 7 |

## Top finding

1. **RAT-P1-01** — `rating_morph` senza FK, senza unique, con `rating_id` e morph nullable: punteggi orfani o doppi.
2. **RAT-P1-02** — lo schema `ratings` e `rating_morph` è creato da 3 migration ciascuno; il risultato dipende dall'ordine.

## Gate

- PHPStan `Modules/Rating`: **0 errori** (level max, 2026-11-16).
- Pest: **skip documentato** (timeout 420 s senza output, DB test `10.100.200.53` non raggiungibile).

## Riferimenti

[ECC](../ecc/rating-ecc-audit.md) · [epics](./epics.md) · [story](./stories/module-bmad-audit.story.md)
