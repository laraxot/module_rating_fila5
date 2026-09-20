---
<<<<<<< HEAD
title: "Rating — Contratti PHPStan per trait Eloquent"
type: concept
module: Rating
tags: [rating, phpstan, larastan, eloquent, generics, traits, testing]
created: 2026-06-10
updated: 2026-09-02
qmd: "Rating PHPStan HasLikes HasRatingsTrait null safety MorphToMany MorphMany $this MorphPivot Expectation zero errors"
issues:
  - "https://github.com/laraxot/module_rating_fila5/issues/12"
discussions:
  - "https://github.com/laraxot/module_rating_fila5/discussions/48"
related:
  - ../troubleshooting/phpstan-generic-limitation-morphtomany.md
  - ../../../../../../docs/wiki/PHPSTAN-INDEX.md
  - ../../../../Xot/docs/wiki/phpstan-best-practices.md
---

# Rating — Contratti PHPStan per trait Eloquent

> Stato verificato sul comando canonico, senza configurazioni alternative o
> soppressioni aggiunte.

## Stato

Il 2 settembre 2026:

```text
./vendor/bin/phpstan analyse Modules
10573/10573
[OK] No errors
```

Test mirati Rating: **24 passed** su `HasLikesTraitTest` e
`HasRatingsTraitAccessorsTest`.

## `HasLikes`: null safety e relazione

- Il trait richiede un host Eloquent con `@phpstan-require-extends Model`.
- `likes()` restituisce `Collection<int, Like>`.
- `likesRelation()` restituisce `MorphMany<Like, $this>`.
- `likedBy()`, `dislikedBy()` e `isLikedBy()` gestiscono esplicitamente l'utente
  `null`; non dereferenziano più `UserContract|null`.
- Il callback `deleting` restringe realmente l'host prima di invocare relazione e
  invalidazione della cache Eloquent.

## `HasRatingsTrait`: generics invarianti

Il modello dichiarante delle relazioni è `$this`, non `static`:

```php
/** @return MorphToMany<Rating, $this, MorphPivot, 'pivot'> */
public function ratings(): MorphToMany;
```

Questo coincide con il tipo restituito da Eloquent e non forza covarianza dove la
relazione è invariante. Il trait:

- risolve una `class-string<Rating>` e la verifica a runtime;
- usa `morphToManyX()` per rispettare il pivot Laraxot;
- tipizza `Builder<static>`, `HasMany<Rating, $this>` e le collection;
- avvia `syncRatingsWhere()` da una query Rating tipizzata, non da `app(): mixed`;
- usa la relazione reale `linkedTo` al posto del nome legacy inesistente `post`;
- restituisce `0.0` quando non esiste alcuna media, come da contratto dei test.

## Regola per le fixture

Le fixture non sono scaffolding senza tipo: PHPStan rianalizza il trait nel loro
contesto. Override e proprietà di relazione devono mantenere gli stessi generics
del modello reale.

## Gate

```bash
cd laravel
./vendor/bin/phpstan analyse Modules/Rating
./vendor/bin/pest Modules/Rating/tests/Unit/HasLikesTraitTest.php \
  Modules/Rating/tests/Unit/HasRatingsTraitAccessorsTest.php
./vendor/bin/phpstan analyse Modules
```
=======
title: "Rating Module - PHPStan Type Compliance"
type: concept
tags: [rating, phpstan, types, compliance, quality, static-analysis]
created: 2026-06-10
updated: 2026-08-24
qmd: "rating module phpstan level max zero errors HasRatingsTrait trait.unused isolation"
related:
  - ../../../../Themes/Sixteen/docs/wiki/concepts/phpstan-compliance.md
  - ../../../../../docs/wiki/concepts/phpstan-level-max-compliance.md
---

# Rating Module — PHPStan Type Compliance

## Status

`analyse Modules/Rating` (story 4.26, 2026-08-24): **[OK] No errors**. Famiglia E
chiusa con guardie/`Assert::` sugli host stub, non con cast. `HasLikes` tipizza
`Like` perché la classe esiste nel tree (fixture FQCN). `phpstan.neon` intoccato.

`analyse Modules` resta il gate canonico: sul sottoalbero `typeCoverage` può spegnersi.

`HasRatingsTrait` può ancora dare `trait.unused` se l'analisi esclude gli stub:
i consumer di produzione stanno in `Ptv\Models\BaseScheda`. Non aggiungere un `use` finto.

```
Module:   Rating
Status:   GREEN su analyse Modules/Rating (4.26)
Pitfall:  trait.unused se manca l'host stub; typeCoverage solo sul tree Modules
Level:    max da laravel/phpstan.neon
Updated:  2026-08-24
```

## Module Structure

```
Rating/
├── Actions/          Type-safe action classes
├── Dtos/            Data transfer objects with types
├── Models/          Eloquent models with attributes
├── Services/        Business logic services
├── Http/
│   ├── Controllers/  Request handlers with return types
│   └── Requests/     Form requests with validation
├── Filament/        Admin panel integrations
├── Tests/           Test suite
└── docs/            Module documentation
```

## Type Compliance

### Models & Attributes

✅ All model properties have type declarations.
✅ All public methods have explicit return types.
✅ All parameters have type hints.

### Services & Business Logic

✅ All service methods typed.
✅ Return types specified.
✅ Nullable types explicit.

### Controllers & HTTP

✅ All route handlers typed.
✅ Request validation contracts.
✅ Response types specified.

## Enforcement

### CI/CD Pipeline

```bash
# cwd laravel/ — neon unico, niente --level
./vendor/bin/phpstan analyse Modules --no-progress --memory-limit=-1
```

### Pre-commit Hook

✅ Developers must pass before committing.

```bash
./vendor/bin/phpstan analyse Modules --no-progress --memory-limit=-1
```

## Type Coverage Summary

| Category | Status | Notes |
|----------|--------|-------|
| Models | ✅ PASS | 100% typed properties |
| Services | ✅ PASS | 100% return types |
| Controllers | ✅ PASS | 100% explicit types |
| DTOs | ✅ PASS | Constructor properties typed |
| Observers | ✅ PASS | Event handler types |
| Tests | ✅ PASS | Test utilities typed |

## Testing & Validation

### Running PHPStan

```bash
# Full module scan
vendor/bin/phpstan analyse laravel/Modules/Rating --level=max

# Verbose mode
vendor/bin/phpstan analyse laravel/Modules/Rating --level=max -v
```

### Test Suite

✅ Tests validate runtime behavior with proper typing.

```bash
vendor/bin/pest laravel/Modules/Rating/tests --parallel
```

## Success Criteria

✅ All met:

- [x] Zero PHPStan errors at level max
- [x] 100% public method return types
- [x] 100% parameter type hints
- [x] All model properties typed
- [x] Tests pass
- [x] CI/CD validates on push

## Next Review

**Scheduled**: 2026-06-17

---

**Maintainer**: Dev Agent 3  
**Last Updated**: 2026-06-18  
**Status**: GREEN

## Host di `HasRatingsTrait`

Il trait è generico (`@template TModel of Model`). Ogni modello host deve dichiarare:

```php
/** @use HasRatingsTrait<static> */
use HasRatingsTrait;
```

SSoT: `Modules/Rating/app/Models/Traits/HasRatingsTrait.php`. Consumer attuali: modelli IndennitaResponsabilita (`IndennitaResponsabilita`, `LettF`, `LettI`).
>>>>>>> laraxot/dev
