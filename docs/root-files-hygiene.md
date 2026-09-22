---
title: "Root files hygiene"
type: guide
tags: [root, files, hygiene, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "root files hygiene"
related:
  - "./schema.md"
---

# Root files hygiene

<<<<<<< HEAD
## 2026-09-22 (regressione: cleanup annullato da un merge)

Il commit `817ec7e` (09:06) aveva riportato la root a 3 `.md` (README.md,
CHANGELOG.md, LICENSE.md) + 1 solo `.code-workspace`, spostando `ARCHITECTURE.md`
in `docs/root-md-files/architecture.md` e deduplicando le varianti case
(`CHANGELOG.MD`/`changelog.md`, `LICENSE.md`/`license.md`).

Il merge successivo `0e0eb5a` (09:10, merge di `887e352` con `70a0901`) ha
**reintrodotto** tutti i file appena rimossi: `ARCHITECTURE.md`, `CHANGELOG.MD`,
`changelog.md`, `license.md`, `README.md.old`,
`_module_rating_fila5.code-workspace`. Il commit successivo `57118d8` ha
ripulito solo il `.code-workspace` duplicato, non i `.md` duplicati.

**Stato verificato al 2026-09-22 (`git ls-tree HEAD` sulla root, non un'ipotesi):**
root ha ancora `ARCHITECTURE.md`, `CHANGELOG.MD`, `CHANGELOG.md`, `LICENSE.md`,
`README.md`, `README.md.old`, `changelog.md`, `license.md` (7 `.md` reali oltre a
`README.md.old`) + `_module_rating.code-workspace`. La cleanup di `817ec7e` **non
è più lo stato attuale**: serve un nuovo giro di dedup/relocate (fuori scope per
il task che ha scritto questa nota, che riguardava solo i marker di conflitto
Git irrisolti sotto `docs/`).

Nota collaterale: il ramo `70a0901` unito in `0e0eb5a` ha nella sua storia un
commit padre mancante (`eb8f5dbe...`, confermato con `git fsck` — "missing
commit"), quindi `git log` su questo repo fallisce oltre `817ec7e` con
`fatal: Failed to traverse parents`. Corruzione/troncamento della history del
repo git indipendente di questo modulo, non solo un problema di file .md;
segnalare prima di fare altre operazioni di history rewriting su questo repo.

=======
>>>>>>> laraxot/dev
## 2026-07-08 16:51

- created `Rating.code-workspace` as the single canonical root workspace file.
