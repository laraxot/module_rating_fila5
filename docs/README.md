<<<<<<< HEAD
# Documentation

This directory contains documentation for the module.

## Structure

- **architecture.md** - Module architecture and design patterns
- **README.md** - This file

## Guidelines

Documentation should be:
- Clear and concise
- Example-driven
- Updated with code changes
- Use Markdown format (.md)
=======
---
title: Rating Module - Valutazione e Feedback
type: documentation
tags:
  - module
  - documentation
  - rating
  - evaluation
  - feedback
created: 2026-07-28
updated: 2026-07-28
---

# ⭐ Rating Module - Sistema di Valutazione

[![Laravel 12.x](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com/)
[![Filament 5.x](https://img.shields.io/badge/Filament-5.x-blue.svg)](https://filamentphp.com/)
[![PHP 8.4](https://img.shields.io/badge/PHP-8.4-blueviolet.svg)](https://www.php.net/)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-Level%2010-brightgreen.svg)](https://phpstan.org/)

> **Rating Module**: Sistema modulare di valutazione e feedback per Laraxot.

## 📋 Overview

Il modulo **Rating** fornisce un sistema completo e flessibile per la gestione di valutazioni e feedback all'interno dell'ecosistema Laraxot. Permette di:

- Creare e gestire sistemi di rating multi-entità
- Associare valutazioni a qualsiasi modello tramite polimorfismo
- Tracciare storia e audit dei rating
- Integrare feedback qualitativo e quantitativo
- Supportare valutazioni gerarchiche (team, dipartimento, azienda)

### Principi Fondamentali

- **Flessibilità**: Supporta rating su qualsiasi entità del sistema
- **Polimorfismo**: Relazioni polimorfiche per associare rating a diverse risorse
- **Audit Trail**: Tracciamento completo della cronologia valutazioni
- **Composabilità**: Facilmente estendibile per casi d'uso specializzati
- **Integrazione**: Si connette naturalmente agli altri moduli tramite Filament

## 🏗️ Architettura

### Directory Structure

```
Modules/Rating/
├── app/
│   ├── Actions/
│   ├── Models/
│   │   ├── Rating.php
│   │   └── RatingCategory.php
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── RatingResource.php
│   │   │   └── RatingCategoryResource.php
│   │   └── Widgets/
│   ├── Contracts/
│   ├── Traits/
│   ├── Enums/
│   └── Events/
├── database/
│   ├── migrations/
│   └── factories/
├── resources/
│   ├── views/
│   └── lang/
├── tests/
└── docs/
    └── README.md
```

### Core Models

#### Rating

Modello principale che rappresenta una singola valutazione.

**Attributi principali:**
- `id` — Identificativo unico
- `user_id` — Utente che ha dato la valutazione
- `rateable_type` — Tipo di entità valutata (polymorphic)
- `rateable_id` — ID dell'entità valutata
- `score` — Punteggio numerico (1-5 o configurable)
- `comment` — Feedback testuale opzionale
- `category_id` — Categoria di valutazione

#### RatingCategory

Categorizzazione logica delle valutazioni per gestire diversi tipi di feedback.

## 🚀 Utilizzo Comune

### Registrare una Valutazione

```php
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingCategory;

$employee = Employee::find(1);
$category = RatingCategory::where('name', 'Performance')->first();

Rating::create([
    'user_id' => auth()->id(),
    'rateable_type' => Employee::class,
    'rateable_id' => $employee->id,
    'category_id' => $category->id,
    'score' => 4,
    'comment' => 'Ottimo lavoro in questo trimestre',
]);
```

## 🔗 Integrazioni Cross-Module

### User Module
Traccia i rating assegnati e ricevuti dagli utenti.

### Activity Module
Registra automaticamente audit trail dei rating tramite Activity Log.

### Performance Module
Utilizza rating storici per calcolare metriche di performance.

## 📝 Database Schema

### Migrations

- `create_ratings_table` — Tabella principale rating
- `create_rating_categories_table` — Categorie di rating

## 📖 Vedi anche

- [Xot Module](../Xot/docs/README.md) — Framework base
- [User Module](../User/docs/README.md) — Integrazione utenti
- [Activity Module](../Activity/docs/README.md) — Audit trail

## 📄 License & Authors

**Authors:**
- Marco Sottana <marco.sottana@gmail.com>

**License:** MIT

---

**Last Updated:** 2026-07-28 — Documentazione migliorata
>>>>>>> laraxot/dev
