---
title: "Bonifica marker merge committati — Rating"
type: story
module: Rating
epic: quality
story_id: "git-status-fleet-merge-markers-rating"
status: done
track: quality/fleet
related:
  - ../../../Xot/docs/bmad/stories/merge-marker-fleet-residue.story.md
---

# git-status-fleet-merge-markers-rating

## Contesto

Il processo automatico "laraxot" ha committato marker di merge conflict non
risolti (`<<<<<<<`, `=======`, `>>>>>>>`, varianti diff3 a 8 char) in file docs.
Strategia canonica (story Xot `merge-marker-fleet-residue`): HEAD pulito →
`git checkout HEAD -- file`; HEAD sporco → restore blob ultimo commit pulito in
history. Tool: `bashscripts/tools/resolve-merge-markers.sh` (ignora marker
dentro code fence).

## Git status iniziale

- Branch: `dev`, up to date con `laraxot/dev`, working tree clean.
- `.gitattributes`: nessun marker.

## Risultati

| Metrica | Valore |
|---|---|
| File candidati (grep marker) | 42 |
| RESTORE_HEAD (HEAD pulito) | 0 |
| RESTORE_HIST (blob ultimo commit pulito) | 39 |
| MANUAL / MANUAL_UNTRACKED | 0 |
| Skipped (marker solo dentro fence) | 3 |
| `git status --porcelain` post-apply | 39 |

Tutti i 39 file ripristinati dal commit pulito `0e26fee8`. File con
`commits_reverted` più alto: `docs/architecture.md` (12). Campionato: il blob
ripristinato contiene già una sezione "Note storiche" che assorbe il contenuto
del vecchio `ARCHITECTURE.md` (features, integration, review system);
il lato HEAD del conflitto era duplicato/rumore di merge — nessuna perdita
rilevante.

## MANUAL irrisolti

Nessuno.

## Verifica finale

- Zero marker `<<<<<<<`/`=======`/`>>>>>>>`/`\|\|\|\|\|\|\|` fuori dai code
  fence nel worktree.
- Nessun commit effettuato (modifiche solo in worktree, come da consegna).

## Pest

Skip: intervento solo su file documentazione (`.md`), nessun comportamento PHP
modificato.
