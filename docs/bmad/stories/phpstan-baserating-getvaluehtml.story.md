---
qmd: "rating bmad stories phpstan baserating getvaluehtml story md"
id: Rating/phpstan-baserating-getvaluehtml
title: "Parse error getValueHtml su BaseRating"
status: done
module: Rating
priority: P0
related:
  - 5.157-phpstan-rating-pivot-get-test.story.md
---
# Story — PHPStan parse `getValueHtml`

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

## Problema

Residuo merge: `if()` vuoto in `BaseRating::getValueHtml()` → parse error PHPStan fleet.

## Fix

- Rimosso `use Illuminate\Support\Arr` inutilizzato.
- Ripristinato corpo `getValueHtml()` (Money per etichette «Importo», altrimenti stringa pivot).
- Argomento `money()`: `(int) round((float) value * 100)` — il helper Cknow interpreta i `float` come euro interi, non centesimi.
- Test unitari in `BaseRatingModelTest` con pivot `RatingMorph` in memoria (no DB).

## Gate

- `php -l` su `BaseRating.php`
- `phpstan analyse Modules/Rating`
- Pest scope `BaseRatingModelTest`

## Gate finale
- PHPStan Modules/Rating: 0
- Pest BaseRatingModelTest: see session
- hasChildRatings() per evitare query in unit test



### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
