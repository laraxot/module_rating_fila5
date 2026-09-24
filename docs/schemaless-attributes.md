<<<<<<< HEAD
<<<<<<< HEAD
# Schemaless Attributes — Rating Module

**Package**: [`spatie/laravel-schemaless-attributes`](https://github.com/spatie/laravel-schemaless-attributes)
**Status**: ✅ CORRECT (Rating extends BaseRating)

---

## Architecture

```
Rating (Modules\Rating\Models\Rating)
  └── extends BaseRating (Modules\Rating\Models\BaseRating)
        └── extends BaseModel (Modules\Rating\Models\BaseModel)
              └── extends XotBaseModel (Modules\Xot\Models\XotBaseModel)
```

`BaseRating` is the single source of truth for:
- `casts()` — defines `'extra_attributes' => SchemalessAttributes::class`
- `scopeWithExtraAttributes()` — filters by JSON attributes
- `$fillable`, `linkedTo()`, `registerMediaConversions()`

> [!IMPORTANT]
> Never duplicate these methods in `Rating.php`. Extend `BaseRating` instead.

---

## Setup Checklist

### 1. Model — Correct Cast

```php
// BaseRating.php — inherited by all Rating models
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

/** @return array<string, string> */
protected function casts(): array
{
    return [
        'extra_attributes' => SchemalessAttributes::class,
        // ...
    ];
}
```

> [!WARNING]
> Use `Spatie\SchemalessAttributes\Casts\SchemalessAttributes` (with `Casts\`).
> NOT `Spatie\SchemalessAttributes\SchemalessAttributes`.

### 2. PHPDoc

```php
/**
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes $extra_attributes
 * @method static Builder|Rating withExtraAttributes(array|string $attributes = [], mixed $value = null)
 */
```

### 3. Migration

```php
$table->schemalessAttributes('extra_attributes');
```

---

## Query Patterns

```php
// Single attribute filter
Rating::withExtraAttributes('anno', 2024)->get();

// Multiple attribute filter
Rating::withExtraAttributes(['anno' => 2024, 'type' => 'performance'])->get();

// Direct JSON path (alternative)
Rating::where('extra_attributes->anno', 2024)->get();
```

### Scope Implementation (BaseRating)

```php
public function scopeWithExtraAttributes(
    Builder $query,
    array|string $attributes = [],
    mixed $value = null
): Builder {
    if (is_string($attributes) && $value !== null) {
        return $query->where("extra_attributes->{$attributes}", $value);
    }
    if (is_array($attributes)) {
        foreach ($attributes as $key => $val) {
            $query = $query->where("extra_attributes->{$key}", $val);
        }
    }
    return $query;
}
```

---

## Get & Set Attributes

```php
// Set (always call save() after!)
$rating->extra_attributes->set('anno', 2024);
$rating->extra_attributes->set(['anno' => 2024, 'type' => 'performance']);
$rating->save();

// Get (with default)
$anno = $rating->extra_attributes->get('anno', (int) date('Y'));

// Dot notation for nested values
$value = $rating->extra_attributes->get('nested.property', 'default');

// Remove
$rating->extra_attributes->forget('key');
$rating->save();
```

---

## Common Errors

| Error | Why | Fix |
|-------|-----|-----|
| `$casts` property | Deprecated in Laravel 11+ | Use `protected function casts(): array` |
| Wrong import | Missing `Casts\` namespace | `use Spatie\...\Casts\SchemalessAttributes` |
| Scope ignores params | Old `modelScope()` pattern | Use `where("extra_attributes->{$key}", $value)` |
| Missing `save()` | Attributes not persisted | Always call `$model->save()` after set |
| `property_exists()` | Doesn't work with casts | Use `isset()` or `getAttribute()` |

---

## Integration with Laravel Data

```php
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Attributes\Validation\Max;

class RatingData extends Data {
    public function __construct(
        public string $title,
        #[Max(100)]
        public ?string $description = null,
        public Lazy|int|null $anno = null,
    ) {}

    public static function fromModel(Rating $rating): self {
        return new self(
            title: $rating->title ?? '',
            description: $rating->extra_attributes->get('description'),
            anno: Lazy::create(fn() => $rating->extra_attributes->get('anno')),
        );
    }
}
```

---

## References

- [spatie/laravel-schemaless-attributes](https://github.com/spatie/laravel-schemaless-attributes)
- [Laravel News Article](https://laravel-news.com/laravel-schemaless-attributes-package)
- [Xot Schemaless Guide](../../Xot/docs/spatie-schemaless-attributes.md)
- [IndennitaResponsabilita Usage](../../IndennitaResponsabilita/docs/rating-schemaless-usage.md)
- [Rating Errors & Fixes](./schemaless-attributes-errors.md)
=======
=======
>>>>>>> 77b9106 (.)
# Spatie Laravel Schemaless Attributes - Usage in Rating Module

This document outlines the correct usage patterns for `spatie/laravel-schemaless-attributes` within the `Rating` module. For a comprehensive guide on schemaless attributes across the PTVX project, please refer to the [main project documentation](../../../docs/claude/schemaless-attributes.md).

## 🎯 Overview

The `Rating` module heavily utilizes schemaless attributes to store dynamic configurations for ratings, such as `anno` (year), and other specific settings that can vary.

## 🚨 CRITICAL ARCHITECTURE RULE

> [!CAUTION]
> **NEVER** use `wherePivot('anno', ...)` to filter ratings by year.
> 
> The `anno` attribute is a schemaless property of the `Rating` model itself (stored in `extra_attributes`), **NOT** a column in the `rating_morph` pivot table. Applying `wherePivot` on it will fail or yield incorrect results.

### Correct Relationship Filtering Pattern

To get ratings for a specific year linked to a model:

1.  **Filter Ratings first**: Find the `Rating` records for that year using `withExtraAttributes`.
2.  **Match via relationship**: Use the Eloquent relationship on your model and filter by the retrieved Rating IDs (usually via `syncRatingsWhere` or manual ID matching).

---

## ✅ Correct Usage Patterns

As detailed in the main guide, all three patterns for using `withExtraAttributes()` are valid and correct:

### Pattern 1: Array Parameter (RECOMMENDED)

Use this for single or multiple conditions when readability is a priority.

```php
// ✅ CORRECT - Pass an array of conditions
$ratings = Rating::withExtraAttributes(['anno' => 2025])->get();

// ✅ CORRECT - Multiple conditions
$ratings = Rating::withExtraAttributes([
    'anno' => 2025,
    'is_readonly' => false
])->get();
```

### Pattern 2: String + Value Parameters (ALTERNATIVE)

Suitable for simple queries with a single condition.

```php
// ✅ CORRECT - Pass key and value separately
$ratings = Rating::withExtraAttributes('anno', 2025)->get();
```

### Pattern 3: Direct JSON Query (FOR COMPLEX QUERIES)

Use for complex conditions, nested JSON paths, or when maximum SQL control is needed.

```php
// ✅ CORRECT - Direct query on JSON path
$ratings = Rating::where('extra_attributes->anno', 2025)->get();

// ✅ CORRECT - Complex JSON queries with operators
$ratings = Rating::where('extra_attributes->anno', '>=', 2024)
    ->where('extra_attributes->is_readonly', false)
    ->get();
```

## 🚨 PHPStan False Positive

PHPStan may incorrectly report errors on `withExtraAttributes()` due to its use of Laravel's magic scope methods and `debug_backtrace()`. Refer to the [main guide](../../../docs/claude/schemaless-attributes.md#fix-per-phpstan) for solutions, including PHPDoc annotations and configuration adjustments.

## 🔗 Related Documentation

*   [Main Schemaless Attributes Guide (PTVX)](../../../docs/claude/schemaless-attributes.md)
*   [Rating Module README](../README.md)
*   [HasRatingsTrait Best Practices (IndennitaResponsabilita Module)](../../IndennitaResponsabilita/docs/rating-schemaless-usage.md) - *Note: This document provides context specific to IndennitaResponsabilita's usage.*
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
