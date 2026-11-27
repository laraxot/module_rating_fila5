---
title: "ADR — Rating"
type: index
tags: [adr, decisioni, rating]
created: 2026-11-18
updated: 2026-11-24
---

# ADR — Rating

Rating è consumato da più moduli, ognuno con la propria classe concreta e spesso su una connessione diversa: le sue
decisioni riguardano **cosa significa una riga della pivot `rating_morph`** e **dove vivono le interfacce** che i
moduli consumatori implementano.

**Quando leggerli**: prima di scrivere una query su `rating_morph` o su `ratings()`, di aggiungere un aggregato (somme,
conteggi, percentuali) o un'interfaccia nuova.

Formato e regole: [action-behavioral-contract](../../../Xot/docs/rules/action-behavioral-contract.md) (5 sezioni,
`## Verifica` obbligatoria, nome = argomento senza date).

## Decisioni

- [Opzioni e voti nella stessa pivot](rating-morph-options-and-votes-same-pivot.md) — in `rating_morph` `user_id` nullo = opzione attiva sul model, valorizzato = voto.
- [I contratti dei model stanno in app/Models/Contracts](model-contracts-live-in-models-contracts.md) — un'interfaccia con `@phpstan-require-extends Model` va lì, le altre in `app/Contracts`.
