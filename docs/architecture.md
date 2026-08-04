# Rating Module Architecture

Lightweight reference to architecture. See consolidated documentation:

- [README](./README.md) — Overview and module description
- [FAQ](./faq.md) — Quick answers (implementation, database, Filament, testing, performance, security, troubleshooting, upgrade)
- [Index](./index.md) — Navigation to wiki analysis

## Core Design

**Polymorphic ratings system** for any Eloquent model.

- One rating per user per entity (unique constraint)
- 1-5 score scale, optional comments
- HasRatingsTrait for model integration
- QueueableAction pattern for business logic
- Event-driven cache invalidation
- Multi-language translation support

## Key Tables

```
ratings (rateable_type, rateable_id, user_id, score, comment, timestamps)
rating_categories (id, name, description, timestamps)
```

**Indexes:** (rateable_type, rateable_id), (user_id), (score), (created_at)

## Consumer Pattern

Any module uses Rating via trait:

```php
use Modules\Rating\Traits\HasRatingsTrait;

class Product extends Model {
    use HasRatingsTrait;
}

// Available methods
$product->ratings;          // Relations
$product->averageRating();  // Average score
$product->ratedBy($user);   // Check user rated
```

**Circular dependency rule:** Rating never imports from consumers (User, Product, Service, Employee). Reverse dependency only (consumer → Rating via trait, Actions, Events).

## Quality Gates

- **PHPStan Level 10** compliance
- **PHPMD** cleancode, codesize, design rules
- **PHP Insights** best practices
- **Pest tests** with 80%+ coverage
- **Migrations** use XotBaseMigration for tenant-awareness

## See Also

Full topic-specific guidance in [FAQ](./faq.md).
Related wiki analysis: [Rating Module Analysis](../../docs/wiki/analysis/modules/rating/)
