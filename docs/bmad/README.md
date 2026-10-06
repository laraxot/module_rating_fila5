---
title: "Rating Module"
type: documentation
module: Rating
updated: 2026-09-16
---

# Rating Module

Sistema di criteri di valutazione polimorfici (`ratings` / `rating_morph`) usato dalle schede HR
(Performance, IndennitaResponsabilita, ecc.) via `HasRatingsTrait`.

## Navigazione docs

| Area | Path |
|------|------|
| **BMAD attivo** (Select «altro» + note) | [bmad/README.md](bmad/README.md) |
| Architecture / index generici | [architecture.md](architecture.md) · [index.md](index.md) |
| Design Select+Textarea | [stories/rating-altro-option-conditional-textarea-design.story.md](stories/rating-altro-option-conditional-textarea-design.story.md) |
| Criteri a scelta | [criteri-a-scelta-multipla.md](criteri-a-scelta-multipla.md) |

## Canon UI (2026-09-16) — una riga

Con figli: **Select + Textarea** sempre; option «altro» = `''`; placeholder = `null`;
`note` required solo se `selectIsOther === ''`. Dettaglio: [bmad/](bmad/README.md).

## GitHub (pack attuale)

- Design: https://github.com/laraxot/module_rating_fila5/issues/57
- Impl: https://github.com/laraxot/module_rating_fila5/issues/58
- Discussion: https://github.com/laraxot/module_rating_fila5/discussions/59
- D-8 filtro: https://github.com/laraxot/module_rating_fila5/issues/60

## Nota conflitti docs

Questo README aveva marker di merge non risolti (`<<<<<<< HEAD`); ripulito 2026-09-16.
Preferire sempre `docs/bmad/` per lavoro in corso; bozze in `docs/stories/` con
`ALTRO_KEY='altro'` sono superseded-pointer.

<!-- swarm-docs:index:start -->

## Mappa della documentazione (indice di radice, generato dalla passata swarm-docs 2026-10-06)

Sezione generata: raggruppamento euristico per nome e titolo, nessun file e' stato spostato o rinominato. Marcatori: `[orfano]` = prima di questa passata nessun file della cartella `docs/` lo linkava; `[dup]` = sospetto duplicato (vedi sezione dedicata); `[marker di merge]` = contiene `<<<<<<<` o `>>>>>>>` non risolti.

### Entry point e struttura

- Modulo o tema: [../README.md](../README.md) (vetrina), [../../Xot/docs/README.md](../../Xot/docs/README.md) (docs del modulo base Xot)
- [INDEX.md](./INDEX.md): indice gia' presente
- [purpose.md](./purpose.md): scopo (esiste anche l'equivalente italiano/inglese, possibile duplicato)
- [scopo.md](./scopo.md): scopo (esiste anche l'equivalente italiano/inglese, possibile duplicato)
- Architettura: [architecture.md](./architecture.md)
- Architettura: [architecture-rules.md](./architecture-rules.md)
- Architettura BMAD: [bmad/architecture.md](./bmad/architecture.md)
- [bmad/README.md](./bmad/README.md)
- [wiki/index.md](./wiki/index.md)
- [wiki/README.md](./wiki/README.md)
- Story BMAD (posizione canonica): [bmad/stories/](./bmad/stories/) (84 file)

### Sottocartelle

| Cartella | File .md (ricorsivo) | Entry point | Nota |
| --- | --- | --- | --- |
| [bmad/](./bmad/) | 245 | [README.md](./bmad/README.md), [INDEX.md](./bmad/INDEX.md), [index.md](./bmad/index.md) |  |
| [concepts/](./concepts/) | 1 | nessuno |  |
| [headroom/](./headroom/) | 1 | [README.md](./headroom/README.md) |  |
| [llm-wiki/](./llm-wiki/) | 6 | [index.md](./llm-wiki/index.md) |  |
| [logs/](./logs/) | 0 | nessuno |  |
| [prompts/](./prompts/) | 2 | nessuno |  |
| [raw/](./raw/) | 8 | [README.md](./raw/README.md), [index.md](./raw/index.md) | materiale grezzo |
| [roadmap/](./roadmap/) | 7 | [README.md](./roadmap/README.md) |  |
| [schema/](./schema/) | 0 | nessuno |  |
| [screenshots/](./screenshots/) | 0 | nessuno |  |
| [stories/](./stories/) | 64 | nessuno | legacy: la posizione canonica e' `bmad/stories/` |
| [wiki/](./wiki/) | 44 | [README.md](./wiki/README.md), [INDEX.md](./wiki/INDEX.md), [index.md](./wiki/index.md) |  |
| [workflows/](./workflows/) | 1 | nessuno |  |

### Sovrapposizioni rilevate (nessuna azione eseguita)

- `stories/` (64 file) e `bmad/stories/`: 0 stessi nomi, 0 byte-identici. La posizione canonica e' `bmad/stories/`.
- `bmad/` contiene 142 file .md di radice, 133 con lo stesso nome di un file di `docs/` e 128 byte-identici: probabile mirror della radice dentro `bmad/`, che dovrebbe ospitare solo artefatti BMAD.

### File di radice per argomento

#### Agenti AI e regole di lavoro (13)

- [QMD-SETUP.md](./QMD-SETUP.md): QMD Setup — Module Rating [dup]
- [agent-confidence-discipline.md](./agent-confidence-discipline.md): Disciplina agenti per massimizzare la confidenza [orfano]
- [agent-confidence-protocol.md](./agent-confidence-protocol.md): Massima confidenza agente [orfano]
- [agent-edit-discipline.md](./agent-edit-discipline.md) [orfano]
- [codex-error-fix.md](./codex-error-fix.md) [orfano]
- [confidence-guidelines.md](./confidence-guidelines.md): Massimizzare il livello di confidenza [orfano] [dup]
- [confidence_guidelines.md](./confidence_guidelines.md): Massimizzare il livello di confidenza [orfano] [dup]
- [copilot-redundancy-audit-2026-05-25.md](./copilot-redundancy-audit-2026-05-25.md) [orfano]
- [copilot-redundancy-audit.md](./copilot-redundancy-audit.md): Copilot Redundancy Audit [orfano]
- [no-ai-tool-scaffold-dirs.md](./no-ai-tool-scaffold-dirs.md): No AI/tool scaffold directories in module tree [orfano]
- [ponytail-audit-over-engineering.md](./ponytail-audit-over-engineering.md): Ponytail audit — Rating (over-engineering)
- [qmd-setup.md](./qmd-setup.md): QMD Setup — Module Rating [orfano] [dup]
- [second-brain.md](./second-brain.md) [orfano]

#### PHPStan, qualita e test (43)

- [BAD_PRACTICES.md](./BAD_PRACTICES.md): Bad Practices – Rating [orfano] [dup]
- [BEST_PRACTICES.md](./BEST_PRACTICES.md): Best Practices – Rating [dup]
- [FALSE_FRIENDS.md](./FALSE_FRIENDS.md): False Friends – Rating [orfano] [dup]
- [METODI_DUPLICATI_ANALISI.md](./METODI_DUPLICATI_ANALISI.md) [orfano] [dup]
- [PHPSTAN_L10.md](./PHPSTAN_L10.md): PHPStan Level 10 Compliance — Rating Module [orfano]
- [QUALITY_REPORT.md](./QUALITY_REPORT.md): Quality Report — Rating [orfano]
- [REDUNDANCY_ANALYSIS.md](./REDUNDANCY_ANALYSIS.md) [orfano] [dup]
- [bad-practices.md](./bad-practices.md): Bad Practices – Rating [orfano] [dup]
- [bad_practices.md](./bad_practices.md): Bad Practices – Rating [orfano] [dup]
- [best-practices.md](./best-practices.md): Best practices — Rating [dup]
- [best_practices.md](./best_practices.md): Best Practices – Rating [orfano] [dup]
- [code-quality-analysis.md](./code-quality-analysis.md): Code Quality Analysis - Rating Module [orfano]
- [code-quality-improvement-report.md](./code-quality-improvement-report.md): Code Quality Improvement Report — Rating [orfano]
- [code-quality-report.md](./code-quality-report.md): Code quality — modulo Rating [orfano]
- [code-redundancy-audit.md](./code-redundancy-audit.md): Code redundancy audit — Rating [orfano]
- [coverage.md](./coverage.md): Coverage del modulo Rating
- [cyclomatic-complexity-report.md](./cyclomatic-complexity-report.md): Cyclomatic Complexity Report - Module: Rating [orfano]
- [dry-kiss-analysis.md](./dry-kiss-analysis.md): 🐄 DRY & KISS Analysis - Rating [orfano]
- [duplicate-methods-analysis.md](./duplicate-methods-analysis.md): Analisi Metodi Duplicati - Modulo Rating [orfano]
- [duplicate-methods-report.md](./duplicate-methods-report.md): Report: Metodi con nome duplicato nei moduli e nei temi [orfano] [dup]
- [duplicate-methods.md](./duplicate-methods.md): Metodi duplicati — Rating [orfano] [dup]
- [duplicate_methods.md](./duplicate_methods.md): Metodi duplicati — Rating [orfano] [dup]
- [duplicate_methods_report.md](./duplicate_methods_report.md): Report: Metodi con nome duplicato nei moduli e nei temi [orfano] [dup]
- [false-friends.md](./false-friends.md): False Friends – Rating [orfano] [dup]
- [false_friends.md](./false_friends.md): False Friends – Rating [orfano] [dup]
- [metodi-duplicati-analisi.md](./metodi-duplicati-analisi.md): 🐄⚡ ANALISI METODI DUPLICATI - SUPER MUCCA EDITION [orfano] [dup]
- [metodi_duplicati_analisi.md](./metodi_duplicati_analisi.md) [orfano] [dup]
- [model-factory-coverage.md](./model-factory-coverage.md): Rating — copertura model / migration / seeder / factory [orfano]
- [phpstan-errors-roadmap.md](./phpstan-errors-roadmap.md): PHPStan Level 10 Errors Roadmap - Modulo Rating [orfano]
- [phpstan-fixes-2026-01.md](./phpstan-fixes-2026-01.md): PHPStan Fixes - Modulo Rating [orfano] [dup]
- [phpstan-fixes-2026.md](./phpstan-fixes-2026.md): phpstan fixes 2026 01 [orfano]
- [phpstan-fixes-analysis.md](./phpstan-fixes-analysis.md) [orfano]
- [phpstan-fixes.md](./phpstan-fixes.md): PHPStan Fixes - Modulo Rating [dup]
- [phpstan-linked-to-contract.md](./phpstan-linked-to-contract.md): PHPStan: contratto linkedTo e attributo parent_id nei test
- [phpstan-swarm-2026.md](./phpstan-swarm-2026.md): PHPStan swarm — Rating (2026-09-07) [orfano]
- [phpstan-swarm.md](./phpstan-swarm.md): phpstan swarm 2026 [orfano]
- [quality-audit.md](./quality-audit.md): Audit di qualita: modulo Rating
- [redundancy-analysis.md](./redundancy-analysis.md) [orfano] [dup]
- [redundancy-audit-2026-05-21.md](./redundancy-audit-2026-05-21.md): Rating redundancy audit 2026-05-21 [orfano] [dup]
- [redundancy-audit.md](./redundancy-audit.md): Rating redundancy audit 2026-05-21 [orfano] [dup]
- [redundancy-report.md](./redundancy-report.md): Redundancy Report — Modulo Rating
- [redundancy_analysis.md](./redundancy_analysis.md) [orfano] [dup]
- [testing-and-coverage.md](./testing-and-coverage.md): Rating — test e coverage [orfano]

#### Git, sync e conflitti (6)

- [conflict-resolution.md](./conflict-resolution.md): Conflict Resolution — Module Rating [orfano]
- [git-multi-org-sync-handoff.md](./git-multi-org-sync-handoff.md): Handoff multi-org sync (STORY-003) [orfano]
- [merge-conflict-files-list.md](./merge-conflict-files-list.md) [orfano]
- [merge-conflicts-list.md](./merge-conflicts-list.md) [orfano]
- [multi-org-sync-laraxot-provtv.md](./multi-org-sync-laraxot-provtv.md): Sincronizzazione multi-organizzazione (laraxot + provtv) [orfano]
- [no-git-lfs.md](./no-git-lfs.md): Git LFS vietato: linea guida e prototipo .gitattributes [orfano]

#### Bug fix e troubleshooting (5)

- [TROUBLESHOOTING.md](./TROUBLESHOOTING.md): Troubleshooting – Rating [dup]
- [bugfix-supported-locale-translation-and-morph-table-name.md](./bugfix-supported-locale-translation-and-morph-table-name.md): SupportedLocale label mancante + hardcoded table name errato in test [orfano]
- [faq.md](./faq.md): Rating Module - FAQ
- [schemaless-attributes-errors.md](./schemaless-attributes-errors.md): Schemaless Attributes - Errori e Correzioni
- [troubleshooting.md](./troubleshooting.md): Troubleshooting – Rating [dup]

#### Architettura e pattern (11)

- [ON-DEMAND-PATTERN.md](./ON-DEMAND-PATTERN.md): On-Demand Pattern — Module Rating [dup]
- [PATTERNS.md](./PATTERNS.md): Architectural Patterns – Rating
- [PROJECT-STRUCTURE.md](./PROJECT-STRUCTURE.md): Project Structure — Module Rating [orfano] [dup]
- [architecture-rules.md](./architecture-rules.md): Architectural Rules & Guidelines [orfano]
- [architecture.md](./architecture.md): Rating Architecture
- [core-functionality.md](./core-functionality.md) [orfano]
- [filament-table-architecture.md](./filament-table-architecture.md): Dove si configura la tabella di una Resource Filament [orfano]
- [migration-patterns.md](./migration-patterns.md) [orfano]
- [on-demand-pattern.md](./on-demand-pattern.md): On-Demand Pattern — Module Rating [orfano] [dup]
- [project-structure.md](./project-structure.md): Project Structure — Module Rating [orfano] [dup]
- [rating-architecture.md](./rating-architecture.md): Rating System - Architecture Analysis & Fixes [orfano]

#### Prodotto, roadmap e pianificazione (24)

- [PRODUCT_LAUNCH_PLAN.md](./PRODUCT_LAUNCH_PLAN.md): Rating Module - Product Launch Plan [orfano] [dup]
- [PRODUCT_ROADMAP.md](./PRODUCT_ROADMAP.md): Rating Module - Product Roadmap [orfano] [dup]
- [PRODUCT_STRATEGY.md](./PRODUCT_STRATEGY.md): Rating Module - Product Strategy [orfano] [dup]
- [SPRINT_PLANNING.md](./SPRINT_PLANNING.md): Rating Module - Sprint Planning [orfano] [dup]
- [USER_RESEARCH.md](./USER_RESEARCH.md): Rating Module - User Research [orfano] [dup]
- [cosa-migliorare.md](./cosa-migliorare.md): Cosa migliorare: modulo Rating
- [launch-plan.md](./launch-plan.md): Product Launch Plan: Rating Module [orfano]
- [prd.md](./prd.md): PRD: Rating Module
- [product-launch-plan.md](./product-launch-plan.md): Rating - Product Launch Plan [dup]
- [product-requirements.md](./product-requirements.md): Product Requirements Document (PRD) [orfano]
- [product-roadmap.md](./product-roadmap.md): Rating - Product Roadmap [dup]
- [product-strategy.md](./product-strategy.md): Rating - Product Strategy [dup]
- [product_launch_plan.md](./product_launch_plan.md): Rating Module - Product Launch Plan [orfano] [dup]
- [product_roadmap.md](./product_roadmap.md): Rating Module - Product Roadmap [orfano] [dup]
- [product_strategy.md](./product_strategy.md): Rating Module - Product Strategy [orfano] [dup]
- [release-marketing-standard.md](./release-marketing-standard.md): Release e README marketing — Rating [orfano]
- [roadmap-miglioramenti.md](./roadmap-miglioramenti.md): Roadmap — Rating, il modulo più piccolo con la coscienza più pulita [orfano]
- [roadmap.md](./roadmap.md): Product Roadmap - Rating Module
- [sprint-planning-meeting.md](./sprint-planning-meeting.md): Rating - Sprint Planning Meeting
- [sprint-planning.md](./sprint-planning.md): Sprint Planning: Rating Module [orfano] [dup]
- [sprint_planning.md](./sprint_planning.md): Rating Module - Sprint Planning [orfano] [dup]
- [strategy.md](./strategy.md): Product Strategy: Rating Module [orfano]
- [user-research.md](./user-research.md): User Research: Rating Module [dup]
- [user_research.md](./user_research.md): Rating Module - User Research [orfano] [dup]

#### Filament, UI e grafici (3)

- [filament-version.md](./filament-version.md): Filament Version Declaration — Rating [orfano]
- [ratings-value-field-types.md](./ratings-value-field-types.md): Analisi: tipi di campo per value in rating_morph (intero, decimal, select, radio, testo... [orfano]
- [select-nelle-valutazioni-analisi.md](./select-nelle-valutazioni-analisi.md): Un criterio di valutazione con risposta a scelta: analisi

#### Dati, modelli e schema (9)

- [MIGRATIONS.md](./MIGRATIONS.md): Rating Module — Migrations [orfano] [dup]
- [contracts-naming.md](./contracts-naming.md): Contracts Naming & Placement [orfano]
- [criteri-a-scelta-multipla.md](./criteri-a-scelta-multipla.md): Criteri a scelta: opzioni in JSON, figli del criterio, o altro
- [data-models.md](./data-models.md)
- [migrations.md](./migrations.md): Rating Module — Migrations [orfano] [dup]
- [schema.md](./schema.md): Module Schema [orfano]
- [schemaless-attributes.md](./schemaless-attributes.md): Schemaless Attributes — Rating Module [orfano]
- [tipo-di-campo-del-criterio.md](./tipo-di-campo-del-criterio.md): Il tipo di campo di un criterio: intero, decimale, select, radio, testo libero
- [tipo-di-risposta-del-criterio-analisi.md](./tipo-di-risposta-del-criterio-analisi.md): Che tipo di risposta vuole un criterio: analisi

#### Configurazione, permessi e confini (4)

- [FRAMEWORKS.md](./FRAMEWORKS.md): Rating — Framework Integration Notes [orfano]
- [binary-assets.md](./binary-assets.md): Asset binari [orfano]
- [configuration.md](./configuration.md): Rating Module Configuration [orfano]
- [laravel-13-upgrade.md](./laravel-13-upgrade.md): Upgrade Laravel 13 - Rating 🐄✨ [orfano]

#### Indici, standard e meta-documentazione (9)

- [CHANGELOG.md](./CHANGELOG.md): Changelog [orfano] [dup]
- [LICENSE.md](./LICENSE.md): License [orfano] [dup]
- [case-sensitivity-rules.md](./case-sensitivity-rules.md): Case Sensitivity Rules - Rating Module [orfano]
- [changelog.md](./changelog.md) [orfano] [dup]
- [file-naming-rules.md](./file-naming-rules.md) [orfano]
- [license.md](./license.md) [orfano] [dup]
- [purpose.md](./purpose.md): Rating — scopo del modulo e come raggiungerlo meglio
- [readme-en.md](./readme-en.md): ⭐ Rating — English presentation [orfano]
- [scopo.md](./scopo.md): Rating — scopo, confini e come servirlo meglio [orfano]

#### Altri documenti (dominio e analisi specifiche) (7)

- [PERFORMANCE-OPTIMIZATION.md](./PERFORMANCE-OPTIMIZATION.md): Performance Optimization — Module Rating [orfano] [dup]
- [api-integration.md](./api-integration.md) [orfano]
- [dove-vive-un-contratto.md](./dove-vive-un-contratto.md): Dove vive un contratto: app/Models/Contracts/ o app/Contracts/ [orfano]
- [module.md](./module.md): Rating Module — Doctrine [orfano]
- [performance-optimization.md](./performance-optimization.md): Performance Optimization — Module Rating [orfano] [dup]
- [up.md](./up.md): Up [orfano]
- [user-interface.md](./user-interface.md): User Interface [orfano]

### Sospetti duplicati (richiedono approvazione per il consolidamento)

Nessun file e' stato toccato. Proposte di destinazione nella story [swarm-phpstan-modular-docs-org](../../Xot/docs/bmad/stories/swarm-phpstan-modular-docs-org.story.md).

- contenuto identico: [BAD_PRACTICES.md](./BAD_PRACTICES.md), [bad-practices.md](./bad-practices.md)
- contenuto identico: [FALSE_FRIENDS.md](./FALSE_FRIENDS.md), [false-friends.md](./false-friends.md)
- contenuto identico: [MIGRATIONS.md](./MIGRATIONS.md), [migrations.md](./migrations.md)
- contenuto identico: [ON-DEMAND-PATTERN.md](./ON-DEMAND-PATTERN.md), [on-demand-pattern.md](./on-demand-pattern.md)
- contenuto identico: [PERFORMANCE-OPTIMIZATION.md](./PERFORMANCE-OPTIMIZATION.md), [performance-optimization.md](./performance-optimization.md)
- contenuto identico: [PROJECT-STRUCTURE.md](./PROJECT-STRUCTURE.md), [project-structure.md](./project-structure.md)
- contenuto identico: [QMD-SETUP.md](./QMD-SETUP.md), [qmd-setup.md](./qmd-setup.md)
- contenuto identico: [REDUNDANCY_ANALYSIS.md](./REDUNDANCY_ANALYSIS.md), [redundancy-analysis.md](./redundancy-analysis.md), [redundancy_analysis.md](./redundancy_analysis.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [BAD_PRACTICES.md](./BAD_PRACTICES.md), [bad-practices.md](./bad-practices.md), [bad_practices.md](./bad_practices.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [BEST_PRACTICES.md](./BEST_PRACTICES.md), [best-practices.md](./best-practices.md), [best_practices.md](./best_practices.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [CHANGELOG.md](./CHANGELOG.md), [changelog.md](./changelog.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [FALSE_FRIENDS.md](./FALSE_FRIENDS.md), [false-friends.md](./false-friends.md), [false_friends.md](./false_friends.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [LICENSE.md](./LICENSE.md), [license.md](./license.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [METODI_DUPLICATI_ANALISI.md](./METODI_DUPLICATI_ANALISI.md), [metodi-duplicati-analisi.md](./metodi-duplicati-analisi.md), [metodi_duplicati_analisi.md](./metodi_duplicati_analisi.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [PRODUCT_LAUNCH_PLAN.md](./PRODUCT_LAUNCH_PLAN.md), [product-launch-plan.md](./product-launch-plan.md), [product_launch_plan.md](./product_launch_plan.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [PRODUCT_ROADMAP.md](./PRODUCT_ROADMAP.md), [product-roadmap.md](./product-roadmap.md), [product_roadmap.md](./product_roadmap.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [PRODUCT_STRATEGY.md](./PRODUCT_STRATEGY.md), [product-strategy.md](./product-strategy.md), [product_strategy.md](./product_strategy.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [SPRINT_PLANNING.md](./SPRINT_PLANNING.md), [sprint-planning.md](./sprint-planning.md), [sprint_planning.md](./sprint_planning.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [TROUBLESHOOTING.md](./TROUBLESHOOTING.md), [troubleshooting.md](./troubleshooting.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [USER_RESEARCH.md](./USER_RESEARCH.md), [user-research.md](./user-research.md), [user_research.md](./user_research.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [confidence-guidelines.md](./confidence-guidelines.md), [confidence_guidelines.md](./confidence_guidelines.md)
- stesso nome normalizzato (maiuscole, `_`/`-`, `-en`, `-report`): [duplicate-methods-report.md](./duplicate-methods-report.md), [duplicate-methods.md](./duplicate-methods.md), [duplicate_methods.md](./duplicate_methods.md), [duplicate_methods_report.md](./duplicate_methods_report.md)
- stesso titolo: [BEST_PRACTICES.md](./BEST_PRACTICES.md), [best_practices.md](./best_practices.md)
- stesso titolo: [PRODUCT_LAUNCH_PLAN.md](./PRODUCT_LAUNCH_PLAN.md), [product_launch_plan.md](./product_launch_plan.md)
- stesso titolo: [PRODUCT_ROADMAP.md](./PRODUCT_ROADMAP.md), [product_roadmap.md](./product_roadmap.md)
- stesso titolo: [PRODUCT_STRATEGY.md](./PRODUCT_STRATEGY.md), [product_strategy.md](./product_strategy.md)
- stesso titolo: [SPRINT_PLANNING.md](./SPRINT_PLANNING.md), [sprint_planning.md](./sprint_planning.md)
- stesso titolo: [USER_RESEARCH.md](./USER_RESEARCH.md), [user_research.md](./user_research.md)
- stesso titolo: [duplicate-methods-report.md](./duplicate-methods-report.md), [duplicate_methods_report.md](./duplicate_methods_report.md)
- stesso titolo: [duplicate-methods.md](./duplicate-methods.md), [duplicate_methods.md](./duplicate_methods.md)
- stesso titolo: [phpstan-fixes-2026-01.md](./phpstan-fixes-2026-01.md), [phpstan-fixes.md](./phpstan-fixes.md)
- stesso titolo: [redundancy-audit-2026-05-21.md](./redundancy-audit-2026-05-21.md), [redundancy-audit.md](./redundancy-audit.md)

### Senza front matter (28)

[CHANGELOG.md](./CHANGELOG.md), [FRAMEWORKS.md](./FRAMEWORKS.md), [INDEX.md](./INDEX.md), [bad_practices.md](./bad_practices.md), [best_practices.md](./best_practices.md), [binary-assets.md](./binary-assets.md), [code-quality-report.md](./code-quality-report.md), [confidence_guidelines.md](./confidence_guidelines.md), [copilot-redundancy-audit-2026-05-25.md](./copilot-redundancy-audit-2026-05-25.md), [criteri-a-scelta-multipla.md](./criteri-a-scelta-multipla.md), [duplicate_methods.md](./duplicate_methods.md), [duplicate_methods_report.md](./duplicate_methods_report.md), [false_friends.md](./false_friends.md), [license.md](./license.md), [metodi-duplicati-analisi.md](./metodi-duplicati-analisi.md), [phpstan-fixes-2026-01.md](./phpstan-fixes-2026-01.md), [phpstan-swarm-2026.md](./phpstan-swarm-2026.md), [product_launch_plan.md](./product_launch_plan.md), [product_roadmap.md](./product_roadmap.md), [product_strategy.md](./product_strategy.md), [roadmap-miglioramenti.md](./roadmap-miglioramenti.md), [schemaless-attributes-errors.md](./schemaless-attributes-errors.md), [schemaless-attributes.md](./schemaless-attributes.md), [select-nelle-valutazioni-analisi.md](./select-nelle-valutazioni-analisi.md), [sprint_planning.md](./sprint_planning.md), [tipo-di-campo-del-criterio.md](./tipo-di-campo-del-criterio.md), [tipo-di-risposta-del-criterio-analisi.md](./tipo-di-risposta-del-criterio-analisi.md), [user_research.md](./user_research.md)

<!-- swarm-docs:index:end -->
