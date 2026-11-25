---
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
issues: []
discussions: []
title: "Rating: bonifica .md con data/timestamp nel nome file"
type: story
module: Rating
status: backlog
track: docs-hygiene
qmd: "docs filename no date timestamp bonifica rating"
related:
  - ../../../../../../docs/sprint-status.yaml
  - ../../../../Xot/docs/bmad/stories/docs-filename-no-date-bonifica-xot.story.md
---
# Rating: .md senza data/timestamp nel nome (batch trovato 2026-09-22)

## Context and Problem Statement

Direttiva utente questa sessione: nessun filename `.md` con data o timestamp.
Stesso batch di lavoro di [[docs-filename-no-date-bonifica-xot]] (Xot),
perimetro Rating.

## Decision Drivers

- Richiesta utente / acceptance criteria della story
- Vincoli BMAD, second brain, Pest gate e dati sacri

## Considered Options

- Status quo (non fare)
- Implementare come descritto nel Decision Outcome

## Decision Outcome

Scelta: **implementare**, perché i driver sopra.

## Perche'

Direttiva utente questa sessione: nessun filename `.md` con data o timestamp.
Stesso batch di lavoro di [[docs-filename-no-date-bonifica-xot]] (Xot),
perimetro Rating.

## Scope

- `docs/redundancy-audit-rating.md`
- `docs/copilot-redundancy-audit.md`
- `docs/stories/phpstan-fleet-fix.story.md`
- `docs/stories/phpstan-fix.story.md`
- `docs/stories/phpstan-fix-story.story.md`
- `docs/bmad/stories/cleanup-rating.story.md`

## Acceptance

- [ ] Ogni file rinominato senza data/timestamp o eccezione giustificata
- [ ] Collisioni di nome con file gia' tracciato: riconciliazione contenuto,
      non rename meccanico
- [ ] Nessun link rotto residuo dopo i rename
- [ ] `qmd update`

<!-- GateGuard facts: (1) no new doc — edit existing docs-filename-no-date-bonifica-rating.story.md; related Xot docs-md-filename-date-debt; (2) linked from Xot date-debt diary; (3) append diary not create; (4) user: "Append breve esito nella story Xot date-debt e, se esiste, story locale bmad." -->

## Diario 2026-11-17 (wave date-debt)

- `phpstan-swarm-2026.md` → `phpstan-swarm.md`
- ISO datati → `*-from-iso` (+ alias WT `*-legacy`) con `superseded_by` verso canon
  (`copilot-redundancy-audit`, `redundancy-audit`, `cleanup-rating`, `auditcoverage-reinjection`,
  `phpstan-fleet-fix`, `phpstan-post-sync-restore`, `quality-gates-phpstan-swarm`,
  `ratingdata-api-restore-after-laraxot-sync`).
- Residui rule-regex: **3** (`phpstan-fixes-modulo-rating.md`, 2× `phpstan-fix-178876*.story.md`).
- Nessun delete. Canon: `Xot/.../docs-md-filename-date-debt.story.md`.

<!-- GateGuard: append diary; linked from Xot docs-md-filename-date-debt wave 24d. -->

## Diario 2026-11-24d (wave date-debt companion)

- Ignored `*-[0-9][0-9].md`: `phpstan-fixes-2026-01.md` → `phpstan-fixes-jan-historical.md` + stub → `phpstan-fixes.md`.
- `bmad/phpstan-fixes-2026-01.md` → promote `bmad/phpstan-fixes.md` + stub dated.
- Date ACTIVE Rating post-wave: **0**. Nessun `rm`. Parent: `Xot/.../docs-md-filename-date-debt.story.md`.


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
