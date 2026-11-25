---
type: story
status: done
module: Rating
story_id: "0101-manuals-screenshots-dashboard-widget"
title: "Manuale Rating + widget dashboard + conflitti merge"
qmd: "rating manuals screenshots dashboard widget conflicts"
updated: 2026-11-25
---

# Story 0101 — Manuali e dashboard Rating

## Acceptance

- [x] Conflitti `<<<<<<<` risolti preferendo laraxot/dev su Models/Filament/boot
- [x] `docs/manuals/manuale-utente.md` con screenshot reali del pannello
- [x] Dashboard non più Blade vuota: `RatingPanelStatsOverviewWidget`
- [x] Modulo abilitato in `modules_statuses.json`
- [x] Emoji login tema rimossa (tofu in headless)

## Note

Impostazioni form vuoto = intenzionale (`RatingConfigData`). Screenshot lista
catturati autenticati; dashboard dipende da sessione/APP_URL host.
