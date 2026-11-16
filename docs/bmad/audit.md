---
title: "Audit BMAD — Rating"
type: audit
status: review
updated: 2026-11-16
module: Rating
qmd: "audit BMAD Rating source-first qualità"
---

# Audit BMAD — Rating

SSoT dettagliata: [audits/rating-audit.md](./audits/rating-audit.md)

## Sintesi (2026-11-16)

| Metrica | Valore |
|---|---:|
| PHP `app/` | 76 |
| Test | 42 |
| Resources | 4 |
| Actions | 3 |
| Services | 0 |
| Policy `return true` | 4 |
| Marker | 0 |

## Lo scopo in una frase **Rating rende "dare un punteggio a qualcosa" un meccanismo unico e riusabile, invece di una tabella di voti reinventata in ogni modulo che valuta.**

## Gate

- PHPStan modulo / `Modules`: 0 errori (verifica 2026-11-16).
- Pest: da eseguire in ambiente testing non produttivo.
- Security/runtime: story figlie su finding P0/P1 dell'audit dettagliato.
