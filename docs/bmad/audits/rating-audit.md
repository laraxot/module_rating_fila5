---
title: "Audit approfondito modulo Rating"
type: audit
status: review
updated: 2026-11-16
module: Rating
qmd: "audit approfondito Rating inventario PHPStan Pest policy Filament Actions"
---

# Audit approfondito — Rating

## Metodo

Source-first (2026-11-16): inventario filesystem, `rg` su policy/marker/label,
lettura purpose esistente, PHPStan globale Modules già a 0 errori. Nessuna UI
inventata. Pest dichiarato solo se eseguito.

## Inventario misurato

| Area | Conteggio |
|---|---:|
| PHP in `app/` | 76 |
| Test PHP | 42 |
| Models (`app/Models/*.php`) | 9 |
| Policy files (approx) | 8 |
| Resource Filament | 4 |
| Actions | 3 |
| Services | 0 |
| Migration | 8 |
| Lang IT files | 50 |
| Marker conflitto | 0 |
| Occorrenze `return true` in Policy | 4 |
| Ratio test/app | 0.55 |

## Scopo (da docs esistenti / codice)

## Lo scopo in una frase **Rating rende "dare un punteggio a qualcosa" un meccanismo unico e riusabile, invece di una tabella di voti reinventata in ogni modulo che valuta.**

## Finding preliminari (da inventario)

- Nessun finding automatico critico dall'inventario; completare review sicurezza/runtime con story dedicate.

## Finding approfonditi (codice)

- **P0/P1** Dual DB: `BaseModel` forza `connection=rating`; leaf moduli usano connection proprie — rischio cross-DB se fallback al model Rating.
- **P1** Trait god `HasRatingsTrait` + legacy `RatingTrait` / `HasRating` unused.
- **P2** Probe PHPStan in `app/`.

## Gate

```bash
cd laravel
php -d memory_limit=2G ./vendor/bin/phpstan analyse Modules/Rating
# Pest solo fuori da 10.100.200.15 e con DB testing raggiungibile
./vendor/bin/pest Modules/Rating/tests --no-coverage
```

PHPStan `Modules` (2026-11-16): **0 errori** sul tree completo.

## Piano

Vedi [piano-miglioramento.md](../piano-miglioramento.md).

## Riferimenti

- [audit.md](../audit.md)
- [ECC](../../ecc/rating-ecc-audit.md)
- [Story](../stories/module-bmad-audit.story.md)
