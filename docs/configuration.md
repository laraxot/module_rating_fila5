<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
---
title: "Rating Module Configuration"
type: guide
tags: [configuration, rating]
created: 2026-07-14
updated: 2026-07-14
qmd: "configuration"
related:
  - "./conflict-resolution.md"
---

=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
=======
>>>>>>> 2025498 (.)
# Rating Module Configuration

## `composer.json` Dependencies

The `composer.json` file for the Rating module (`laravel/Modules/Rating/composer.json`) defines its core dependencies and development tools.

### `require` Section

This section lists the essential packages required for the module to function correctly. Adherence to semantic versioning is crucial, typically using caret (`^`) or tilde (`~`) operators to allow for patch and minor updates while preventing breaking changes.

```json
"require": {
    "spatie/laravel-schemaless-attributes": "^3.0",
    "laravel/framework": "^12.0",
    "filament/filament": "^5.0"
}
```

*   `spatie/laravel-schemaless-attributes`: Essential for handling flexible, schemaless data structures within the module's Eloquent models.
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
*   `laravel/framework`: Specifies compatibility with Laravel 13.x.
=======
*   `laravel/framework`: Specifies compatibility with Laravel 12.x.
>>>>>>> e8cf105 (Check & fix styling)
=======
*   `laravel/framework`: Specifies compatibility with Laravel 12.x.
>>>>>>> 77b9106 (.)
=======
*   `laravel/framework`: Specifies compatibility with Laravel 12.x.
>>>>>>> c91c8c3 (.)
=======
*   `laravel/framework`: Specifies compatibility with Laravel 12.x.
>>>>>>> 2025498 (.)
*   `filament/filament`: Indicates integration with Filament Admin Panel version 5.x.

### `require-dev` Section

This section includes packages necessary for development, testing, and code quality analysis. These dependencies are not required for the module's runtime operation.

```json
"require-dev": {
    "pestphp/pest": "^2.0",
    "pestphp/pest-plugin-laravel": "^2.0"
}
```

*   `pestphp/pest`: The testing framework used for unit and feature tests.
*   `pestphp/pest-plugin-laravel`: Provides Laravel-specific testing utilities for Pest.

### `repositories` Section

This section is vital for local development within a monorepo structure. It instructs Composer to look for specific packages (other local modules) at a given file path instead of fetching them from Packagist. This facilitates seamless development and testing of interconnected modules.

```json
"repositories": [
    {
        "type": "path",
        "url": "../Xot"
    },
    {
        "type": "path",
        "url": "../Tenant"
    },
    {
        "type": "path",
        "url": "../UI"
    }
]
```

*   `../Xot`: References the core `Xot` module, which provides foundational classes and utilities for Laraxot.
*   `../Tenant`: References the `Tenant` module, likely for multi-tenancy features.
*   `../UI`: References the `UI` module, containing shared UI components.

### Scripts and Configuration

The `scripts` section defines Composer scripts for common development tasks, including:
*   `post-autoload-dump1`: Publishes cookie consent vendor assets.
*   `analyse`: Runs PHPStan for static analysis.
*   `test`: Executes Pest tests without coverage.
*   `test-coverage`: Executes Pest tests with HTML coverage reporting.
*   `format`: Formats code using PHP-CS-Fixer.

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
The `config` section ensures consistent package sorting and allows necessary Composer plugins. `minimum-stability` is set to `dev` and `prefer-stable` to `true` to allow for development dependencies while preferring stable releases.
=======
The `config` section ensures consistent package sorting and allows necessary Composer plugins. `minimum-stability` is set to `dev` and `prefer-stable` to `true` to allow for development dependencies while preferring stable releases.
>>>>>>> e8cf105 (Check & fix styling)
=======
The `config` section ensures consistent package sorting and allows necessary Composer plugins. `minimum-stability` is set to `dev` and `prefer-stable` to `true` to allow for development dependencies while preferring stable releases.
>>>>>>> 77b9106 (.)
=======
The `config` section ensures consistent package sorting and allows necessary Composer plugins. `minimum-stability` is set to `dev` and `prefer-stable` to `true` to allow for development dependencies while preferring stable releases.
>>>>>>> c91c8c3 (.)
=======
The `config` section ensures consistent package sorting and allows necessary Composer plugins. `minimum-stability` is set to `dev` and `prefer-stable` to `true` to allow for development dependencies while preferring stable releases.
>>>>>>> 2025498 (.)
