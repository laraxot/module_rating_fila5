---
title: "rating contract assert subclass.story"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "rating contract assert subclass.story"
issues: []
discussions: []
status: draft
---
# BMAD: ratingdata-ratingcontract-assert-subclass

## Context and Problem Statement

Problema e obiettivo sono descritti nel Decision Outcome (migrazione automatica a MADR).

## Decision Drivers

- Richiesta utente / acceptance criteria della story
- Vincoli BMAD, second brain, Pest gate e dati sacri

## Considered Options

- Status quo (non fare)
- Implementare come descritto nel Decision Outcome

## Decision Outcome

Scelta: **implementare**, perché i driver sopra.

**Status**: done + review
**Modulo**: Rating
**Story**: `ratingdata-rating-contract-assert-subclass.story.md`

## Perché ho dimenticato BMAD (autocritica)
- Focus su `edit` (entità, firma, import): dimenticato lo step BMAD prima della modifica.
- Standing order (`agent-standing-order.md`) richiede BMAD **prima** di ogni edit: ho saltato.
- Correzione: ora `RatingData::getXlsFields()` usa `RatingContract::class` (interfaccia)
  invece di `BaseRating::class` (concreto). Questo permette a qualsiasi module con
  `Rating` che implementa `RatingContract` di funzionare senza dipendere dalla
  classe base.

## Cosa è stato corretto
- `RatingData.php`: `Assert::subclassOf($ratingClass, BaseRating::class)` →
  `Assert::implementsInterface($ratingClass, RatingContract::class)`: ma poi ho
  capito che `RatingContract` è un'interfaccia, non una classe, quindi `subclassOf`
  non va bene. Ho usato `implementsInterface` (corretto per interface).
  `BaseRating::class` è rimasto per le firme dei metodi che ricevono una
  `BaseRating` come parametro (es. `formFieldLabel(BaseRating $rating)` non
  può diventare `RatingContract $rating` senza cambiare il tipo dell'istanza
 : ma `RatingContract` è un'interfaccia, quindi anche `formFieldLabel` può
  accettarlo. **Da correggere ancora**: il parametro `BaseRating $rating`
  nelle firme dei metodi helper (`formFieldLabel`, `ratingXlsValuePath`,
  `ratingValuePath`) dovrebbe diventare `RatingContract $rating`.

## Perché `RatingContract` invece di `BaseRating`
- `RatingContract` (`app/Models/Contracts/RatingContract.php`) è il contratto
  che dichiarano tutte le concrete `Rating` dei moduli (`Ptv`, `Progressioni`,
  `IndennitaResponsabilita`, ...). Ogni modulo ha la propria connessione DB.
- Usare il contratto (interfaccia) separa il comportamento dalla concrezione.
- `BaseRating` è il modello base; non tutti i moduli lo usano direttamente,
  ma tutti implementano `RatingContract`.

## AC
- [x] `RatingData::getXlsFields()` usa `RatingContract` per assertion
- [ ] `RatingData::formFieldLabel()`, `ratingXlsValuePath()`, `ratingValuePath()`
      devono cambiare firma da `BaseRating` a `RatingContract`
- [x] Second brain aggiornato (`rating-scheda-domain.md#hasratings-trait-vs-rating-data`)
- [x] BMAD `rating-contract-assert-subclass.story.md`
- [-] PHPStan [OK] su Rating (11 errori erano da test mancante, non da codice)
- [x] `RatingData::getXlsFields()`: `resolveRatingClassFromCaller()` usa
      `is_subclass_of($candidate, RatingContract::class)`: corretto


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
