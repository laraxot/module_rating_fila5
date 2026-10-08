---
issues: []
discussions: []
title: "📚 RATING Module - Documentation Index"
type: guide
tags: [index, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "00 INDEX"
related:
  - "./bad-practices.md"
---

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

### BMAD stories attive

| Story | Stato | Scopo |
|------|-------|-------|
| [RATING-2.2](stories/2.2.phpstan-rating-test-contracts.story.md) | review | Contratti statici trait e fixture |
| [RATING-2.3](stories/2.3.phpstan-rating-tail-contracts.story.md) | review | Ultimi 11 findings nei test Rating: cold module a zero |
| [4.26 coda](../../../../docs/bmad/stories/4.26.coda-moduli-phpstan-zero.story.md) | review | PHPStan modulo a zero (E+F) |
| [rating-morphs-sti-parent-fqcn](bmad/stories/rating-morphs-sti-parent-fqcn.story.md) | done | `ratingMorphTypes()` su figlio STI: alias + FQCN del padre (ripristinata 2026-10-07) |
| [2026-10-08 PHPStan RatingMorphData](stories/2026-10-08-phpstan-rating-morph-data-missing.story.md) | done | Closure `$missing` morta (duplicava `addIfMissing()`), tornata con un merge |

## Documentazione BMAD del modulo

Aggiornata il 2026-10-07 dopo la risoluzione dei marker di merge nei docs (versioni composte, non scelte a un lato).

- [Brainstorming](bmad/brainstorming.md): decisioni, questioni aperte, opzioni scartate.
- [Architecture](bmad/architecture.md)
- [Quick reference](bmad/quick-reference.md)
- [Setup guide](bmad/setup-guide.md)
- Story: cartella [bmad/stories/](bmad/stories/).
- Cluster PHPStan L10 Rating e Xot: [cluster-3-rating-xot-phpstan-l10-2026-10-06.story.md](bmad/stories/cluster-3-rating-xot-phpstan-l10-2026-10-06.story.md).

## 🔗 Riferimenti

- [Xot Module](../Xot/docs/00-index.md) - Base classes
- [AGENTS.md](../../../../AGENTS.md) - Project guidelines

---

**Ultimo Aggiornamento**: 2026-03-24
