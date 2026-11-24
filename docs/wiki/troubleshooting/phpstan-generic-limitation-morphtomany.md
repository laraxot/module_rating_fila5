---
title: "PHPStan Generic Limitation: MorphToMany with static"
type: troubleshooting
sources: []
confidence: high
created: 2026-05-06
updated: 2026-05-06
tags: [phpstan, larastan, rating, generic-types, known-limitation]
related:
  - ../../Xot/docs/wiki/troubleshooting/phpstan-fatal-errors-eloquent-properties.md
---

# PHPStan Generic Limitation: MorphToMany with static

## Problem

PHPStan/Larastan cannot reconcile `MorphToMany<Rating, static>` return type when the interface declares `MorphToMany<Rating>`.

### Error Messages
```
Line   Rating/app/Models/Contracts/HasRatingContract.php
 20     Type string in generic type Illuminate\Database\Eloquent\Relations\MorphToMany<...> in PHPDoc tag @return is not subtype of template type...
```

```
Line   Rating/app/Models/Traits/HasRating.php (in context of class Modules\Blog\Models\Article)
 24     Return type MorphToMany<Rating, static(Article)> should be compatible with MorphToMany<Rating, Illuminate\Database\Eloquent\Relations\MorphPivot>
 26     Method Article::ratings() should return MorphToMany<Rating, static(Article)> but returns MorphToMany<Rating, $this(Article)>
```

## Root Cause

PHPStan's template type `TDeclaringModel` on `MorphToMany` is **not covariant**. This is a known PHPStan/Larastan limitation with Eloquent's `static` return type in trait context.

- Interface: `HasRatingContract::ratings(): MorphToMany<Rating>`
- Trait: `HasRating::ratings(): MorphToMany<Rating, static>`
- PHPStan expects exact match, but `static` vs explicit model creates generic type mismatch

## Solution

<<<<<<< .merge_file_sSq24X
**This is a PHPStan limitation, NOT a code bug.**

### What we did
1. Documented the limitation (this page)
2. Verified code works at runtime (Eloquent handles `static` correctly)
3. Did NOT add `@phpstan-ignore` (per project protocol: 0 ignores, 0 baselines)

### Why no @phpstan-ignore
- Project protocol forbids `@phpstan-ignore` in code
- These are false positives from PHPStan's generic type system
- Runtime behavior is correct
=======
**RESOLVED** — passing the concrete pivot class to `morphToManyX()` resolves the generic mismatch.

### What we did

1. Extended `RelationX::morphToManyX()` with an optional `?string $pivotClass = null` parameter (template `TPivot of MorphPivot`). When provided, the relation is built with `->using($pivot::class)`, so PHPStan infers the concrete `MorphToMany<Rating, $this, RatingMorph, 'pivot'>` instead of the base `MorphPivot` returned by `guessMorphPivot()`.
2. Updated `HasRating::ratings()` to call `morphToManyX(Rating::class, 'model', pivotClass: RatingMorph::class)`.
3. Verified: `./vendor/bin/phpstan analyse Modules/Rating --memory-limit=-1 --error-format=raw` → **0 errors**.

### Why this works

- `guessMorphPivot()` returns a base `MorphPivot`; the contract and callers expect the concrete `RatingMorph`.
- Injecting `$pivotClass` lets the caller declare the exact pivot type, so PHPStan's generic inference aligns with the contract instead of hitting the `static`/invariance limitation.
>>>>>>> .merge_file_wJA4u9

## References
- PHPStan blog: https://phpstan.org/blog/whats-up-with-template-covariant
- Larastan issue: Generic type limitations with MorphToMany + static
- Project protocol: `laravel/phpstan.neon` is NEVER modified
<<<<<<< .merge_file_sSq24X

## Status
- **Wave 2026-11-17**: modulo Rating a **0** errori sul gate `Modules/Rating`+`Modules/Lang`.
- Contratto: interface `MorphToMany<Rating, Model>`; trait `MorphToMany<Rating, $this>`; host in-module `RateableHost`.
- Limitazione `static`/invarianza resta nota per analisi cross-module (Blog), non blocca il gate modulo.
=======
- Canonical fix log: [../../phpstan-fixes.md](../../phpstan-fixes.md)

## Status
- **Wave 2026-11-17**: modulo Rating a **0** errori sul gate `Modules/Rating`+`Modules/Lang`.
- Contratto: interface `MorphToMany<Rating, Model>`; trait `MorphToMany<Rating, $this, RatingMorph, 'pivot'>` grazie al `pivotClass` injected.
- Limitazione `static`/invarianza resta nota per analisi cross-module (Blog), non blocca il gate modulo.

## Aggiornamento ripresa

Contratto e trait allineati a `MorphToMany<Rating, Model|$this, RatingMorph, 'pivot'>`. Trait morti (`HasLikes`, `HasRatingsTrait`, `RatingTrait`) rimossi (restano solo `.lock` multi-agente). Canonico fix: [phpstan-fixes.md](../../phpstan-fixes.md).
>>>>>>> .merge_file_wJA4u9
