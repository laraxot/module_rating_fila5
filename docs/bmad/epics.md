---
title: "Epics — Rating"
type: epics
status: active
updated: 2026-11-16
module: Rating
qmd: "epics Rating audit rating_morph integrità migration additiva pulizia residui docs"
---

# Epics — Rating

Roadmap storica: [epics/module-roadmap.md](./epics/module-roadmap.md), [epics/rating-export-ssot.md](./epics/rating-export-ssot.md), [epics/rating-select-altro.md](./epics/rating-select-altro.md). Qui solo gli epic dell'[audit 2026-11-16](./audits/rating-audit.md).

## Epic A — Integrità di `rating_morph` (RAT-P1-01, RAT-P1-02)

**Perché:** il dato valutativo alimenta il riparto; orfani e doppi lo falsano e il DB non li ferma.
**Fatto quando:** una migration **nuova e additiva** (mai modificare le vecchie, mai `--force`) porta unique su (`model_type`, `model_id`, `rating_id`, `user_id`) e l'indice mancante; i dati esistenti sono prima contati con una query di sola lettura (duplicati/orfani); `morphMap` registrato dal provider; test di regressione su doppio inserimento.
**Vincolo:** nessun DDL distruttivo; se esistono duplicati, si decide con l'owner del dato prima di creare l'unique.

## Epic B — Pulizia residui (RAT-P2-01, 02, 03, 04, 05)

Rimuovere `RatingTrait`/`HasRating` e il model-sonda (spostando l'analisi PHPStan nei test), i 5 file `.bak/.old/.to_*` in `app/`, i file in radice (`README.md.old`, `composer.json.tmp`, `ruvector.db` da togliere dal tracking, duplicati di CHANGELOG/LICENSE), fondere `Base*Policy` con la concreta.
**Fatto quando:** `rg --files -g '*.{bak,old,tmp,to_*}' laravel/Modules/Rating` vuoto; PHPStan 0.

## Epic C — Docs affidabili (RAT-P2-06, 07)

Purpose/architecture allineati al codice (fatto in questo giro), 36 `.md` con maiuscole e 13 con data da rinominare con aggiornamento dei link, parità EN (1 file contro 25).
