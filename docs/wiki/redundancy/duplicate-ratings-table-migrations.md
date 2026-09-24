---
title: "RatingTable gemelle e doppia migration ratings"
type: redundancy
owner: Modules/Rating
severity: medium-high
created: 2026-05-22
issues:
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  - "https://github.com/laraxot/platform/issues/90"
=======
  - "https://github.com/laraxot/base_fixcity_fila5/issues/90"
>>>>>>> e8cf105 (Check & fix styling)
=======
  - "https://github.com/laraxot/base_fixcity_fila5/issues/90"
>>>>>>> 77b9106 (.)
=======
  - "https://github.com/laraxot/base_fixcity_fila5/issues/90"
>>>>>>> c91c8c3 (.)
related:
  - ../../redundancy-report.md
  - ../../../docs/redundancy-report.md
---

# Tabelle Filament e migration `ratings`

## Classi Table (stesso resource)

Sotto `RatingResource/Tables/`:

- `RatingTable.php` — schema “zen” (title, type, toggle, …)
- `RatingsTable.php` — colonne id/slug/order/timestamps

Sotto `RatingMorphResource/Tables/`:

- `RatingMorphTable.php` + `RatingMorphsTable.php` (stesso anti-pattern typo/plurale).

Nessun riferimento esplicito nel grep resource → possibile **orfane** o risolte solo da convenzione `XotBaseResource`.

## Migration

- `database/migrations/2023_01_01_000000_create_ratings_table.php`
- `database/migrations/2026_03_12_180000_create_ratings_table.php`

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
**Azione:** una sola `create` owner; colonne in `tableUpdate`; **`git rm`** sui duplicati (mai `_archive_redundant`).
=======
**Azione:** una sola `create` + migration `alter` successive; archiviare la ridondante in `_archive_redundant/` (pattern Notify/Xot).
>>>>>>> e8cf105 (Check & fix styling)
=======
**Azione:** una sola `create` + migration `alter` successive; archiviare la ridondante in `_archive_redundant/` (pattern Notify/Xot).
>>>>>>> 77b9106 (.)
=======
**Azione:** una sola `create` + migration `alter` successive; archiviare la ridondante in `_archive_redundant/` (pattern Notify/Xot).
>>>>>>> c91c8c3 (.)

## Widget

`StatsOverview` duplicato in `Filament/Widgets/` e `HasRatingResource/Widgets/`.

## Tracker

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
[#90](https://github.com/laraxot/platform/issues/90).
=======
[#90](https://github.com/laraxot/base_fixcity_fila5/issues/90).
>>>>>>> e8cf105 (Check & fix styling)
=======
[#90](https://github.com/laraxot/base_fixcity_fila5/issues/90).
>>>>>>> 77b9106 (.)
=======
[#90](https://github.com/laraxot/base_fixcity_fila5/issues/90).
>>>>>>> c91c8c3 (.)
