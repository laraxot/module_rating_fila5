---
title: "Rating — indice documentazione"
type: index
tags: [rating, docs, phpstan, index]
updated: 2026-11-17
qmd: "rating indice documentazione scopo rating polimorfico HasRating phpstan canonici kebab"
related:
  - ./README.md
  - ./phpstan-fixes.md
  - ./architecture.md
  - ./rating-architecture.md
---

# Rating — indice documentazione

**Canonico di navigazione** del modulo. `INDEX.md` e `00-INDEX.md` rimandano qui.

## Scopo (perché esiste)

Il modulo **Rating** assegna voti polimorfici a qualsiasi modello (`HasRating` / `HasRatingContract`): un utente vota un'entità una sola volta (o aggiorna il voto), con aggregazioni (media, conteggi) e admin Filament. Non è un “servizio scoring” generico: la logica vive in **Actions** sotto `Actions/HasRating/`, non in un `RatingService`.

Gate qualità: livello max da `laravel/phpstan.neon` (procedura: [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md)).

## Leggere prima

| Tema | File |
|------|------|
| Panoramica modulo | [README.md](README.md) |
| Architettura / regole | [architecture.md](architecture.md), [architecture-rules.md](architecture-rules.md), [rating-architecture.md](rating-architecture.md) |
| Best practice (DRY/KISS) | [best-practices.md](best-practices.md) |
| PHPStan (stato + cause) | [phpstan-fixes.md](phpstan-fixes.md) |
| MorphToMany / generics | [wiki/troubleshooting/phpstan-generic-limitation-morphtomany.md](wiki/troubleshooting/phpstan-generic-limitation-morphtomany.md) |
| Schema / schemaless | [schema.md](schema.md), [schemaless-attributes.md](schemaless-attributes.md) |
| Product (kebab) | [prd.md](prd.md), [product-strategy.md](product-strategy.md), [product-roadmap.md](product-roadmap.md), [product-launch-plan.md](product-launch-plan.md) |
| Roadmap strutturata | [roadmap/](roadmap/) |
| Wiki locale | [wiki/index.md](wiki/index.md) |

## PHPStan — canonico vs storici

| Ruolo | File |
|-------|------|
| **Canonico** | [phpstan-fixes.md](phpstan-fixes.md) — wave recente, cause radice, link troubleshooting |
<<<<<<< .merge_file_kxmgUW
| Storico (non aggiornare) | [phpstan-errors-roadmap.md](phpstan-errors-roadmap.md), [phpstan-fixes-2026-01.md](phpstan-fixes-2026-01.md), [phpstan-fixes-analysis.md](phpstan-fixes-analysis.md) |
=======
| Storico (non aggiornare) | [phpstan-errors-roadmap.md](phpstan-errors-roadmap.md), [phpstan-fixes-2026-01.md](phpstan-fixes-modulo-rating.md), [phpstan-fixes-analysis.md](phpstan-fixes-analysis.md) |
>>>>>>> .merge_file_5rfvwY
| Procedura swarm (repo) | [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md) |
| Story globale | [all-modules-phpstan-zero-errors.story.md](../../../../docs/stories/all-modules-phpstan-zero-errors.story.md) |

## Nomi UPPERCASE / alias → kebab (non cancellare in massa)

I file `UPPER_SNAKE` o `UPPER-KEBAB` restano per link storici; **non** sono SSoT. Preferire i kebab:

| Alias / legacy | Canonico kebab |
|----------------|----------------|
| `BEST_PRACTICES.md` | [best-practices.md](best-practices.md) |
| `BAD_PRACTICES.md` | (anti-pattern: integrare in best-practices se serve) |
| `PRODUCT_STRATEGY.md` | [product-strategy.md](product-strategy.md) / [strategy.md](strategy.md) |
| `PRODUCT_ROADMAP.md` | [product-roadmap.md](product-roadmap.md) / [roadmap.md](roadmap.md) |
| `PRODUCT_LAUNCH_PLAN.md` | [product-launch-plan.md](product-launch-plan.md) / [launch-plan.md](launch-plan.md) |
| `SPRINT_PLANNING.md` | [sprint-planning.md](sprint-planning.md) |
| `USER_RESEARCH.md` | [user-research.md](user-research.md) |
| `REDUNDANCY_ANALYSIS.md` | [redundancy-report.md](redundancy-report.md), [code-redundancy-audit.md](code-redundancy-audit.md) |
| `METODI_DUPLICATI_ANALISI.md`, `metodi_duplicati_analisi.md` | [metodi-duplicati-analisi.md](metodi-duplicati-analisi.md) |
| `ON-DEMAND-PATTERN.md`, `QMD-SETUP.md`, `PERFORMANCE-OPTIMIZATION.md`, `PROJECT-STRUCTURE.md` | pattern condivisi Themes/on-demand; in Rating usare wiki + questo indice |
| `INDEX.md`, `00-INDEX.md` | **questo file** (`index.md`) |

Convenzione nomi: kebab-case, **senza date** nel filename (eccezione `README.md`).

## Redundancy nota

Esistono stub che puntano a `Themes/docs/shared-components/...` (es. vecchi redirect): se il target è `.gitkeep` o fuori modulo, **non** seguirli — usare i file Rating in tabella sopra o il codice in `app/`.

## Backlink

- [User](../User/docs/README.md) — autori voto  
- [Xot](../Xot/docs/) — `XotBase*`  
- Prompt: [00-start](../../../../bashscripts/docs/prompts/00-start.md) · [57-second-brain](../../../../bashscripts/docs/prompts/57-second-brain.md)
