---
title: "Rating: bonifica docs .md (convenzioni, duplicati, template)"
type: story
status: done
module: Rating
epic: docs-second-brain
story_id: docs-zen-conventions-rating
created: 2026-11-25
updated: 2026-11-25
qmd: "rating docs bonifica kebab-case frontmatter qmd duplicati md5 template fabbricati stub gitkeep-Modules fusione collisioni"
related:
  - ../../../../Xot/docs/bmad/stories/docs-zen-conventions-swarm.story.md
---
# Rating: bonifica docs `.md`

## Context and Problem Statement

Il rumore in `docs/` (copie esatte, varianti `_`/MAIUSCOLO/`-2`, stub generati, template di prodotto
generici) degrada QMD e confonde gli agenti. Obiettivo: una copia canonica per contenuto, nomi kebab,
frontmatter con `title` + `qmd` ovunque, link aggiornati.

## Decision Drivers

- Richiesta utente / acceptance criteria della story
- Vincoli BMAD, second brain, Pest gate e dati sacri

## Considered Options

- Status quo (non fare)
- Implementare come descritto nel Decision Outcome

## Decision Outcome

Scelta: **implementare**, perché i driver sopra.

Parte della lane F della story ombrello
[docs-zen-conventions-swarm](../../../../Xot/docs/bmad/stories/docs-zen-conventions-swarm.story.md).

## Perche'

Il rumore in `docs/` (copie esatte, varianti `_`/MAIUSCOLO/`-2`, stub generati, template di prodotto
generici) degrada QMD e confonde gli agenti. Obiettivo: una copia canonica per contenuto, nomi kebab,
frontmatter con `title` + `qmd` ovunque, link aggiornati.

## Prima / Dopo

| Metrica | Prima | Dopo |
|---|---:|---:|
| file .md | 621 | 527 |
| copie esatte (md5) oltre la prima | 3 | 3 |
| nomi con data | 1 | 0 |
| nomi non kebab | 66 | 0 |
| senza frontmatter | 0 | 0 |
| senza `qmd` | 0 | 0 |
| annidamenti generati | 0 | 0 |

Le copie esatte residue sono solo tra file `*.story.md` (non eliminabili per regola).

## Cosa e' stato eliminato / fuso e perche'

| Causa | File |
|---|---:|
| cfg-template | 39 |
| fused | 23 |
| stub-gitkeep | 12 |
| subsumed | 19 |
| subsumes-dst(replaced) | 2 |

- `cfg-template`: template di prodotto generici (roadmap/strategy/sprint/user-research/launch/confidence/tech-spec)
  senza alcun identificatore reale del modulo (verifica automatica token CamelCase/backtick/snake contro `app/`, `database/`, `config/`, `routes/`).
- `stub-gitkeep*`: stub generati che puntano a `../../../Themes/docs/shared-components/.gitkeep-Modules` (inesistente);
  se contenevano testo reale questo era gia' presente nella copia pulita.
- `md5-dup`: copie byte-identiche; canonica = nome kebab senza suffisso `-N`, fuori da `llm-wiki/`/`bmad/` quando conoscenza generale.
- `fused`/`subsumed`: collisioni `_`/MAIUSCOLO/`-N` sul nome kebab: se contenute nell'altra eliminate, altrimenti
  i paragrafi unici sono stati accodati sotto `## Contenuto fuso da <file>`.
- Rinomine: 19.

## Note specifiche Rating

- 39 template di prodotto (anche MAIUSCOLI `PRODUCT-ROADMAP.md` ecc. in `bmad/`) senza identificatori del modulo: eliminati.
  Link `roadmap.md` rediretti a `bmad/roadmap/README.md`.
- 5 file "stub + contenuto fuso" (`troubleshooting.md`, `roadmap-miglioramenti.md`, `bmad/best-practices.md`, ...):
  rimosso l'header stub `gitkeep-Modules` (frontmatter `status: stub`, `canonical` inesistente), promosso il frontmatter reale.
- Stub vuoti `core-functionality`, `data-models`, `migration-patterns` (root, `bmad/`, `wiki/`): eliminati senza sostituto;
  `api-integration` stub → `wiki/integrations/api-integration.md`.
- Rinomina manuale `stories/phpstan-Rating-fix.md` → `stories/phpstan-rating-fix.md` (non e' `*.story.md`).
- File in `*/stories/` senza suffisso `.story.md` con numerazione a punti (`bmad/stories/5.228-...md`, `5.229-...md`,
  `rating-5.99-...md`) NON rinominati: trattati come story (dubbio, decidere se aggiungere `.story.md`).
- `phpstan-fixes-2026-01.md` fuso in `phpstan-fixes.md` (nome datato).
- Link nelle chiavi YAML `related:` aggiornati (es. `./PATTERNS.md` → `patterns.md`).
- `index-generated.md` contiene ancora link a template/stub rimossi (indice generato: rigenerarlo).

## Casi lasciati in dubbio

- story duplicate identiche (non toccate): bmad/stories/auditcoverage-reinjection-from-iso.story.md | bmad/stories/auditcoverage-reinjection-legacy.story.md
- story duplicate identiche (non toccate): bmad/stories/quality-gates-phpstan-swarm-from-iso.story.md | bmad/stories/quality-gates-phpstan-swarm-legacy.story.md
- story duplicate identiche (non toccate): bmad/stories/ratingdata-api-restore-after-laraxot-sync-from-iso.story.md | bmad/stories/ratingdata-api-restore-after-laraxot-sync-legacy.story.md

## Gate

Solo file `.md` sotto `docs/`: PHPStan/Pint/Pest non applicabili (skip documentato); PHPStan gia' 0.
Misura con `measure.py` (md5, regex nomi, `yaml.safe_load` frontmatter). Link rotti verso file rinominati/rimossi
riscritti nei docs di moduli non bloccati; riferimenti nei moduli con lock attivo segnalati sopra.


### Consequences

- Buono, perché chiude il gap descritto nel Context
- Cattivo, perché richiede write-back docs, lock e quality gate

### Confirmation

Aggiungere prova ripetibile (Pest exit code + conteggio, PHPStan, o skip host documentato).
