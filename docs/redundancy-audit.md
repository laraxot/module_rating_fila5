---
title: "Rating redundancy audit 2026-05-21"
type: audit
module: Rating
tags: [redundancy, livewire, views]
created: 2026-05-21
related:
<<<<<<< HEAD
<<<<<<< HEAD
  - https://github.com/laraxot/base_fixcity_fila5/issues/89
=======
  - https://github.com/laraxot/platform/issues/89
>>>>>>> laraxot/dev
=======
  - https://github.com/laraxot/platform/issues/89
>>>>>>> b2d53b8 (.)
---

# Rating redundancy audit 2026-05-21

High-risk findings:
- Favorite Livewire views are byte-identical in multiple paths:
  - `resources/views/livewire/favorite2.blade.php`
  - `resources/views/livewire/favorite/favorite2.blade.php`
  - `resources/views/livewire/favorite/streamit.blade.php`
- `favorite.blade.php` and `favorite/default.blade.php` are also byte-identical.
<<<<<<< HEAD
<<<<<<< HEAD
- `admin/dashboard/item.blade.php` is duplicated with `Modules/Fixcity`.
=======
- `admin/dashboard/item.blade.php` is duplicated with `Modules/LegacyDomain`.
>>>>>>> laraxot/dev
=======
- `admin/dashboard/item.blade.php` is duplicated with `Modules/LegacyDomain`.
>>>>>>> b2d53b8 (.)
- PHP CS Fixer config files duplicate common module boilerplate.

Risk:
- Livewire view resolution can drift when multiple files imply the same component intent.
<<<<<<< HEAD
<<<<<<< HEAD
- Dashboard item ownership between Rating and Fixcity is unclear.
=======
- Dashboard item ownership between Rating and LegacyDomain is unclear.
>>>>>>> laraxot/dev
=======
- Dashboard item ownership between Rating and LegacyDomain is unclear.
>>>>>>> b2d53b8 (.)

Suggested cleanup order:
1. Identify Livewire component class/view mapping, then keep only the resolved view.
2. If dashboard item is generic, move to UI/Xot; if domain-specific, keep it in the owner module only.
