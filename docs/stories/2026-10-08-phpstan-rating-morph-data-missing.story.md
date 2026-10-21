---
title: "[STORY] PHPStan Rating: closure $missing in RatingMorphData"
type: story
status: done
priority: low
created: 2026-10-08
updated: 2026-10-08
module: Rating
tags: [phpstan, rating, migration, dead-code, merge-regression, swarm]
related:
  - 18.46.analisi-criteri-scelta-e-tipo-campo
---

# PHPStan Rating: closure `$missing` in RatingMorphData

Fase BMAD: Dev + Docs.

## Richiesta

Azzerare gli errori PHPStan guardando lo scopo. Perimetro: `variable.unused` a `RatingMorphData.php:65`.

## Analisi

**Scopo.** `RatingMorphData::updateColumns()` aggiunge al pivot `rating_morph` solo le colonne mancanti (`value`, `note`, `is_winner`, `reward`) in un'unica `ALTER TABLE`. Il controllo "manca?" e' gia' in `addIfMissing()`, che chiama `$migration->hasColumn()`.

`$missing` era una copia di quel controllo (la stessa closure usata davvero in `RatingData::updateColumns()`), mai letta fin dal primo commit del file (752ffcc). Nessuna logica persa: ogni colonna e' protetta da `addIfMissing()`.

**Regressione da merge.** La story `docs/bmad/stories/rating-phpstan-l10-swarm-2026-10-06.story.md` dichiara la riga gia' rimossa; il merge 752ffcc (2026-10-07) l'ha riportata. Corretto di nuovo.

## Modifiche

- Tolta la closure `$missing` (2 righe). Nessun altro cambio.

## Verifica

- `php -l`: nessun errore.
- `phpstan analyse` sul file (con gli altri 6 dello swarm `small-modules`): `[OK] No errors`.
- Pest: non eseguito (MySQL di test irraggiungibile, rc=124); nessun test copre `RatingMorphData`.

## Aperto

- Il tipo di `value` resta incoerente: `createColumns()` usa `decimal(10,3)`, `updateColumns()` usa `integer`. E' gia' tracciato in `18.46.analisi-criteri-scelta-e-tipo-campo.story.md` (le installazioni vive hanno `int(11)`); non toccato qui perche' cambia lo schema.
