---
title: "phpstan-modules-zero"
type: story
status: done
module: "Rating"
tags:
  - phpstan
  - bmad
  - quality-gate
qmd: "phpstan module Rating zero errors quality guardian swarm"
updated: "2026-11-16"
---

# Story: PHPStan zero — Rating

## Scopo

Portare `Modules/Rating` a **0 errori** PHPStan (level max progetto) senza ignore, senza `mixed` di comodo, rispettando Filament/XotBase e array PHP una chiave per riga.

## Metriche

| | |
|---|---|
| Errori iniziali | **0** |
| Errori finali | **0** |
| Data gate | 2026-11-16 |

## Cosa e' stato fatto

Nessun errore al primo scan. Solo gate + story.

## Verifica

```bash
cd laravel && php -d memory_limit=2G ./vendor/bin/phpstan analyse Modules/Rating --no-progress
```

Esito: **0 file_errors**.

## Note operative

- Lock: `bash bashscripts/lock/lock.sh phpstan-Rating 40`
- Activity/User/Xot non toccati (marker/bootstrap altri agenti)
- Filament 5.11 `Filters\Concerns\HasForm`: `form()` canonico; `schema()` e' `@deprecated Use form()`
- Se PHPStan inverte form↔schema: svuotare `/tmp/phpstan` prima di fidarsi

## Collegamenti

- Standing order BMAD / Pest / array PHP
- Swarm quality-guardian sessione 2026-11-16
