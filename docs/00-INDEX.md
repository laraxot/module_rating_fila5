---
issues: []
discussions: []
<<<<<<< .merge_file_7JxUBm
title: "📚 RATING Module - Documentation Index"
type: guide
tags: [index, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "00 INDEX"
=======
title: "Rating: indice operativo"
type: index
status: active
module: Rating
tags: [index, rating, docs]
created: 2026-07-14
updated: 2026-10-14
qmd: "rating indice operativo ratings rating_morph HasRatingsTrait fixcity valutazione cittadino"
>>>>>>> .merge_file_m4zfzr
related:
  - "./bad-practices.md"
---

<<<<<<< .merge_file_7JxUBm
# 📚 RATING Module - Documentation Index

**Path**: `laravel/Modules/Rating/docs/`  
**Modulo**: @Modules/Rating

## 📄 Documenti

### Product
| File | Scopo |
|------|-------|
| PRD.md | Product Requirements |
| PRODUCT_ROADMAP.md | Roadmap |
| PRODUCT_STRATEGY.md | Strategy |
| PRODUCT_LAUNCH_PLAN.md | Launch Plan |

### Development
| File | Scopo |
|------|-------|
| GSD_WORKFLOW.md | GSD Workflow |
| SPRINT_PLANNING.md | Sprint Planning |
| USER_RESEARCH.md | User Research |
=======
# Rating: indice operativo canonico

Percorso: `laravel/Modules/Rating/docs/`. Questo e' l'indice canonico del contratto docs. Gli altri sono varianti: `index.md` (hub del lavoro BMAD sul Select "altro", 2026-09-22), `INDEX.md` (statistiche di luglio), `00-index.md` (copia), `INDEX_GENERATED.md` (elenco generato). Nessun file e' stato rimosso.

Identita', contenuto reale del codice, consumatori e limiti: [README.md](./README.md). Decisioni locali: [decision-log.md](./decision-log.md) (oggi vuoto, solo l'intestazione).

## Stato verificato il 2026-10-14

| Tema | Esito | Prova |
|---|---|---|
| Uso nel progetto | Fixcity (valutazione cittadino sui ticket) e Blog | `SubmitCitizenTicketRatingAction`, import in `Modules/Blog/app` |
| Rotte | solo pannello Filament `rating/admin` (11) | `php artisan route:list --json`; `routes/web.php` e `api.php` vuoti |
| Schede HR (Performance, IndennitaResponsabilita) | non in questo repository | `ls laravel/Modules`; i riferimenti sono storia di un altro progetto |
| Suite Pest | non utilizzabile come prova | 182 test, tutti `SQLiteDatabaseDoesNotExistException` su DB usa-e-getta |
| PHPStan | storico nelle story, non riverificato oggi | story 2.2, 2.3 in stato `review` |

## Directory

| Percorso | Ruolo |
|---|---|
| `README.md`, `00-INDEX.md`, `decision-log.md` | canonico |
| `stories/` (68 file) | cronologia BMAD del modulo; non cancellare ne' rinumerare |
| `bmad/` (257 file) | evidence del lavoro BMAD (architettura, brainstorming, story); l'ingresso e' [bmad/README.md](./bmad/README.md) |
| `wiki/` (85 file) | regole e concetti locali; il registro e' `wiki/log.md` |
| `roadmap/`, `chat/`, `investigation/`, `workflows/` | piani e diagnosi: non descrivono lo stato del codice |
| `raw/` | evidence immutabile |
| `root-md-files/`, `llm-wiki/`, `headroom/`, `graphify/`, `phpstan/`, `prompts/`, `concepts/` | legacy o strumenti, non canonici |
| file `.md` nella radice (140) | misto: molte coppie che differiscono solo per maiuscole o underscore (56 collisioni di maiuscole), da consolidare con DOC-004 e DOC-006 |
| circa 61 stub con `canonical: ../../../Themes/docs/shared-components/...` | il percorso non esiste: la cartella reale e' `Themes/Barthelemy/docs/shared-components/` |

## Documenti tecnici da leggere

- [rating-architecture.md](./rating-architecture.md): analisi del 2026-02-11, nata da un errore in IndennitaResponsabilita (altro progetto).
- [ratings-value-field-types.md](./ratings-value-field-types.md) e [criteri-a-scelta-multipla.md](./criteri-a-scelta-multipla.md): tipi di campo e criteri a scelta.
- [filament-table-architecture.md](./filament-table-architecture.md), [MIGRATIONS.md](./MIGRATIONS.md), [TROUBLESHOOTING.md](./TROUBLESHOOTING.md), [testing-and-coverage.md](./testing-and-coverage.md).

## Prodotto e sviluppo (bozze di modello)

[prd.md](./prd.md), [PRODUCT_ROADMAP.md](./PRODUCT_ROADMAP.md), [PRODUCT_STRATEGY.md](./PRODUCT_STRATEGY.md), [PRODUCT_LAUNCH_PLAN.md](./PRODUCT_LAUNCH_PLAN.md), [SPRINT_PLANNING.md](./SPRINT_PLANNING.md), [USER_RESEARCH.md](./USER_RESEARCH.md).
>>>>>>> .merge_file_m4zfzr

### BMAD stories attive

| Story | Stato | Scopo |
|------|-------|-------|
| [RATING-2.2](stories/2.2.phpstan-rating-test-contracts.story.md) | review | Contratti statici trait e fixture |
| [RATING-2.3](stories/2.3.phpstan-rating-tail-contracts.story.md) | review | Ultimi 11 findings nei test Rating: cold module a zero |
<<<<<<< .merge_file_7JxUBm
| [4.26 coda](../../../../docs/bmad/stories/4.26.coda-moduli-phpstan-zero.story.md) | review | PHPStan modulo a zero (E+F) |
| [rating-morphs-sti-parent-fqcn](bmad/stories/rating-morphs-sti-parent-fqcn.story.md) | done | `ratingMorphTypes()` su figlio STI: alias + FQCN del padre (ripristinata 2026-10-07) |
| [2026-10-08 PHPStan RatingMorphData](stories/2026-10-08-phpstan-rating-morph-data-missing.story.md) | done | Closure `$missing` morta (duplicava `addIfMissing()`), tornata con un merge |
=======
| 4.26 coda (file non trovato nel repository, verificato 2026-10-14) | review | PHPStan modulo a zero (E+F) |
| [rating-morphs-sti-parent-fqcn](bmad/stories/rating-morphs-sti-parent-fqcn.story.md) | done | `ratingMorphTypes()` su figlio STI: alias + FQCN del padre (ripristinata 2026-10-07) |
| [2026-10-08 PHPStan RatingMorphData](stories/phpstan-rating-morph-data-missing.story.md) | done | Closure `$missing` morta (duplicava `addIfMissing()`), tornata con un merge |
>>>>>>> .merge_file_m4zfzr

## Documentazione BMAD del modulo

Aggiornata il 2026-10-07 dopo la risoluzione dei marker di merge nei docs (versioni composte, non scelte a un lato).

- [Brainstorming](bmad/brainstorming.md): decisioni, questioni aperte, opzioni scartate.
- [Architecture](bmad/architecture.md)
- [Quick reference](bmad/quick-reference.md)
- [Setup guide](bmad/setup-guide.md)
- Story: cartella [bmad/stories/](bmad/stories/).
<<<<<<< .merge_file_7JxUBm
- Cluster PHPStan L10 Rating e Xot: [cluster-3-rating-xot-phpstan-l10-2026-10-06.story.md](bmad/stories/cluster-3-rating-xot-phpstan-l10-2026-10-06.story.md).

## 🔗 Riferimenti

- [Xot Module](../Xot/docs/00-index.md) - Base classes
=======
- Cluster PHPStan L10 Rating e Xot: [cluster-3-rating-xot-phpstan-l10-2026-10-06.story.md](bmad/stories/cluster-3-rating-xot-phpstan-l10.story.md).

## Riferimenti

- [Xot Module](../../Xot/docs/00-INDEX.md) - Base classes
>>>>>>> .merge_file_m4zfzr
- [AGENTS.md](../../../../AGENTS.md) - Project guidelines

---

<<<<<<< .merge_file_7JxUBm
**Ultimo Aggiornamento**: 2026-03-24
=======
**Ultimo aggiornamento**: 2026-10-14
>>>>>>> .merge_file_m4zfzr
