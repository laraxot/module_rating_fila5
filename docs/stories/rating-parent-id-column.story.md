---
qmd: "rating stories rating parent id column story md"
title: "Colonna parent_id per gli alberi di criteri"
status: backlog
module: Rating (owner)
created: 2026-10-28
repository: "https://github.com/provtv/base_ptv_fila5_mono"
github_issue: "https://github.com/provtv/base_ptv_fila5_mono/issues"
github_discussion: "https://github.com/provtv/base_ptv_fila5_mono/discussions"
related:
  - ../../../Progressioni/docs/stories/progressioni-audit.epic.md
---
# Colonna parent_id per gli alberi di criteri

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

## Fase BMAD

Analisi + Build. Nata dall'audit del 2026-10-28 (epic `progressioni-audit`).

## Problema (verificato)

`BaseRating` usa `HasRecursiveRelationships` (children, rootAncestorOrSelf...) e ha `parent_id` in fillable/casts, ma `progressione.ratings` non ha la colonna: `children()` & co. danno "Unknown column" appena eseguite (oggi nessun chiamante in Progressioni; ci passano `hasChildRatings()`, `getRatingsFormSchema()` con `loadMissing('children')`). Evidenza: `Rating/app/Models/BaseRating.php:99,128,324`, `HasRatingsTrait.php:560,602`.

## Requisiti

- Verificare quali connection hanno `ratings` senza `parent_id`.
- Aggiungerla nella Data dello schema (se esiste `RatingData::updateColumns`, altrimenti crearla sul modello di RatingMorphData) + migrazione create_* del modulo.

## Criteri di accettazione

- [ ] `parent_id` presente in tutte le tabelle ratings dei moduli che usano gli alberi.
- [ ] Relazioni ad albero eseguibili (smoke in lettura).

## Vincoli

- Dati sacri: niente migrate:fresh/refresh/rollback/--force, niente RefreshDatabase; solo aggiunte idempotenti (hasColumn). Produzione 10.100.200.15: Pest non si esegue, smoke solo in lettura.

## File coinvolti

- `app/Datas/*`
- `Modules/*/database/migrations/*ratings*`

## Verifica

PHPStan livello 10 sui file toccati, Pint; Pest su ambiente di sviluppo (non su 10.100.200.15).


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

PHPStan livello 10 sui file toccati, Pint; Pest su ambiente di sviluppo (non su 10.100.200.15).
