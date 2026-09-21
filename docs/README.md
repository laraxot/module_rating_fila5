<<<<<<< HEAD
---
<<<<<<< HEAD
title: "Rating Module Documentation"
type: documentation
tags: [module, documentation]
created: 2026-06-05
updated: 2026-06-05
---

# Modulo Rating

## Overview

Il modulo **Rating** fa parte dell'ecosistema Laraxot (`laraxot/module_rating_fila5`).

## Scopo

Gestisce rating/valutazioni ed evaluation con supporto schemaless (attributi dinamici), tramite morph relations (`RatingMorph`, `BaseRatingMorph`) applicabili a qualsiasi model tramite `HasRatingsTrait`/`HasRatingContract`. Verificato in codice: `app/Models/Rating.php`, `app/Models/RatingMorph.php`, `app/Models/Traits/HasRatingsTrait.php`.

## Struttura

```
Rating/
├── app/
│   ├── Models/
│   ├── Filament/
│   └── ...
├── docs/
├── lang/
└── resources/
```

## Dipendenze

- [Xot Base](../Xot/docs/)
- [User Module](../User/docs/) (se usa autenticazione)
- [Tenant Module](../Tenant/docs/) (se multi-tenant)

## Collegamenti

- [Regole Architecture](../Xot/docs/architecture/)

## Backlinks

- [Indice Moduli](../README.md)

## TODO

- [ ] Completare descrizione funzionalità
- [ ] Documentare modelli principali
- [ ] Documentare risorse Filament
- [ ] Aggiungere esempi codice

- [Conflict Resolution](conflict-resolution.md)


## Standard Rules & Workflow

- [[BMAD Method](../../../../docs/wiki/concepts/bmad-method.md)]
- [[Context Engineering](../../../../docs/wiki/concepts/context-engineering.md)]
- [[LLM Wiki Governance](../../../../docs/wiki/concepts/llm-wiki-governance.md)]

## Documentation

- [On-Demand Pattern](./ON-DEMAND-PATTERN.md) — Pattern per caricamento efficiente
- [QMD Setup](./QMD-SETUP.md) — Configurazione ricerca locale
- [Performance](./PERFORMANCE-OPTIMIZATION.md) — Metriche e best practice
- [Project Structure](./PROJECT-STRUCTURE.md) — Directory layout
=======
title: "Rating Module"
type: documentation
module: Rating
updated: 2026-09-16
---

# Rating Module

Sistema di criteri di valutazione polimorfici (`ratings` / `rating_morph`) usato dalle schede HR
(Performance, IndennitaResponsabilita, ecc.) via `HasRatingsTrait`.

## Navigazione docs

| Area | Path |
|------|------|
| **BMAD attivo** (Select «altro» + note) | [bmad/README.md](bmad/README.md) |
| Architecture / index generici | [architecture.md](architecture.md) · [index.md](index.md) |
| Design Select+Textarea | [stories/rating-altro-option-conditional-textarea-design.story.md](stories/rating-altro-option-conditional-textarea-design.story.md) |
| Criteri a scelta | [criteri-a-scelta-multipla.md](criteri-a-scelta-multipla.md) |

## Canon UI (2026-09-16) — una riga

Con figli: **Select + Textarea** sempre; option «altro» = `''`; placeholder = `null`;
`note` required solo se `selectIsOther === ''`. Dettaglio: [bmad/](bmad/README.md).

## GitHub (pack attuale)

- Design: https://github.com/laraxot/module_rating_fila5/issues/57
- Impl: https://github.com/laraxot/module_rating_fila5/issues/58
- Discussion: https://github.com/laraxot/module_rating_fila5/discussions/59
- D-8 filtro: https://github.com/laraxot/module_rating_fila5/issues/60

## Nota conflitti docs

Questo README aveva marker di merge non risolti (`<<<<<<< HEAD`); ripulito 2026-09-16.
Preferire sempre `docs/bmad/` per lavoro in corso; bozze in `docs/stories/` con
`ALTRO_KEY='altro'` sono superseded-pointer.
=======
<<<<<<< HEAD
# Rating Module

Module documentation. See wiki for detailed documentation.

- [Architecture](./architecture.md)
- [Index](./index.md)
- [Wiki](../../docs/wiki/analysis/modules/rating/)
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
>>>>>>> b2d53b8 (.)
>>>>>>> laraxot/dev
