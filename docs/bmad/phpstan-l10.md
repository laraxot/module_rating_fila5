---
title: PHPStan Level 10 Compliance — Rating Module
module: Rating
type: quality-gate
status: complete
created: 2026-08-02
<<<<<<< .merge_file_QH3pmG
=======
updated: 2026-10-07
tags: [docs, rating, bmad]
qmd: "phpstan level 10 compliance   rating module rating"
>>>>>>> .merge_file_OFyRiT
---

# PHPStan Level 10 Compliance — Rating Module

## Summary

| Aspect | Value |
|--------|-------|
| **PHPStan L10** | ✅ 0 errors |
| **Status** | Complete |
| **Last verified** | 2026-08-02 |

## Patterns Applied

### 1. Rating Model Types
```php
/**
 * @return Collection<Rating>
 */
public function ratings(): Collection { }

/**
 * @param int $score
 * @return Rating|null
 */
public function getRating(int $score): ?Rating { }
```

### 2. Relation Generics
```php
/**
 * @return HasMany<Rating>
 */
public function ratings(): HasMany { }

/**
 * @return BelongsTo<User>
 */
public function user(): BelongsTo { }
```

### 3. Aggregation Types
```php
/**
 * @return float
 */
public function getAverageRating(): float { }

/**
 * @return array<int, int>
 */
public function getScoreDistribution(): array { }
```

## Verification

```bash
cd laravel/Modules/Rating
phpstan analyse app --level=10
# Expected: 0 errors found
```

## Related Docs

<<<<<<< .merge_file_QH3pmG
- [`phpstan-l10-compliance.md`](../../../docs/wiki/rules/phpstan-l10-compliance.md)
=======
- [`phpstan-l10-compliance.md`](../../../../../docs/wiki/rules/phpstan-l10-compliance.md)
>>>>>>> .merge_file_OFyRiT
- [GitHub Repo](https://github.com/laraxot/module_rating_fila5)

**Status:** ✅ Compliant (2026-08-02)

## Proprieta' magica di una relazione nel trait

`@property-read` su un trait che dichiara una relazione (`ratings()`) deve dire il tipo **caricato**
(`EloquentCollection<int, BaseRating> $ratings`), non quello della relazione. Dettaglio e caso reale:
<<<<<<< .merge_file_QH3pmG
`bmad/stories/rating-phpstan-l10-swarm-level-audit-module-errors.story.md` (sezione Run 4).
=======
`bmad/stories/rating-phpstan-l10-swarm.story.md` (sezione Run 4).
>>>>>>> .merge_file_OFyRiT
