<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8b11e01 (sync(Rating): forward-only changes from base_ptvx_fila5 workspace)
---
title: "Docs archive policy"
type: rule
tags: [docs, archive, policy, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "docs archive policy"
related:
  - "./dry-kiss-analysis.md"
---

# Docs archive policy

`docs/archive/` is local-only scratch/history and must not be used as a canonical module documentation source.

Active module knowledge belongs in normal `docs/*.md`, `docs/wiki/**`, or a precise topical subdirectory. This keeps QMD ingestion deterministic and prevents stale duplicate notes from being treated as current architecture guidance.

=======
# Docs archive policy

`docs/archive/` is local-only scratch/history and must not be used as a canonical module documentation source.

Active module knowledge belongs in normal `docs/*.md`, `docs/wiki/**`, or a precise topical subdirectory. This keeps QMD ingestion deterministic and prevents stale duplicate notes from being treated as current architecture guidance.

>>>>>>> 0fc9b73 (.)
The module `.gitignore` ignores `docs/archive/`; when a useful archived note is still valid, promote it into a live document outside `archive` and link it from the local docs index.
