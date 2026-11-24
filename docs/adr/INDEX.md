---
title: "Indice ADR — Rating"
type: index
module: Rating
status: active
qmd: "Rating ADR dati sacri test isolati decisioni architetturali"
---

# Indice ADR — Rating

## Decisioni

- [rating-is-domain-feedback](rating-is-domain-feedback.md)
- [rating-is-polymorphic](rating-is-polymorphic.md)

## Policy trasversale obbligatoria

Il modulo eredita la decisione owner-local Xot su dati sacri, migrazioni
forward-only e test obbligatoriamente isolati con `laravel/.env.testing`:
[0013-data-sacred-testing](../../Xot/docs/adr/0013-data-sacred-testing.md).

## Authoring

Usare il [template ADR Xot](../../Xot/docs/adr/README.md). Creare un ADR solo
per una decisione difficile da invertire, sorprendente e frutto di un
trade-off reale.
