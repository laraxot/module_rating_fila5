<<<<<<< HEAD
---
title: "Rating — indice documentazione"
type: index
tags: [rating, docs, phpstan, index]
updated: 2026-11-17
qmd: "rating indice documentazione scopo rating polimorfico HasRating phpstan canonici kebab"
related:
  - ./README.md
  - ./phpstan-fixes.md
  - ./architecture.md
  - ./rating-architecture.md
---

# Rating — indice documentazione

**Canonico di navigazione** del modulo. `INDEX.md` e `00-INDEX.md` rimandano qui.

## Scopo (perché esiste)

Il modulo **Rating** assegna voti polimorfici a qualsiasi modello (`HasRating` / `HasRatingContract`): un utente vota un'entità una sola volta (o aggiorna il voto), con aggregazioni (media, conteggi) e admin Filament. Non è un “servizio scoring” generico: la logica vive in **Actions** sotto `Actions/HasRating/`, non in un `RatingService`.

Gate qualità: livello max da `laravel/phpstan.neon` (procedura: [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md)).

## Leggere prima

| Tema | File |
|------|------|
| Panoramica modulo | [README.md](README.md) |
| Architettura / regole | [architecture.md](architecture.md), [architecture-rules.md](architecture-rules.md), [rating-architecture.md](rating-architecture.md) |
| Best practice (DRY/KISS) | [best-practices.md](best-practices.md) |
| PHPStan (stato + cause) | [phpstan-fixes.md](phpstan-fixes.md) |
| MorphToMany / generics | [wiki/troubleshooting/phpstan-generic-limitation-morphtomany.md](wiki/troubleshooting/phpstan-generic-limitation-morphtomany.md) |
| Schema / schemaless | [schema.md](schema.md), [schemaless-attributes.md](schemaless-attributes.md) |
| Product (kebab) | [prd.md](prd.md), [product-strategy.md](product-strategy.md), [product-roadmap.md](product-roadmap.md), [product-launch-plan.md](product-launch-plan.md) |
| Roadmap strutturata | [roadmap/](roadmap/) |
| Wiki locale | [wiki/index.md](wiki/index.md) |

## PHPStan — canonico vs storici

| Ruolo | File |
|-------|------|
| **Canonico** | [phpstan-fixes.md](phpstan-fixes.md) — wave recente, cause radice, link troubleshooting |
| Storico (non aggiornare) | [phpstan-errors-roadmap.md](phpstan-errors-roadmap.md), [phpstan-fixes-2026-01.md](phpstan-fixes-2026-01.md), [phpstan-fixes-analysis.md](phpstan-fixes-analysis.md) |
| Procedura swarm (repo) | [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md) |
| Story globale | [all-modules-phpstan-zero-errors.story.md](../../../../docs/stories/all-modules-phpstan-zero-errors.story.md) |

## Nomi UPPERCASE / alias → kebab (non cancellare in massa)

I file `UPPER_SNAKE` o `UPPER-KEBAB` restano per link storici; **non** sono SSoT. Preferire i kebab:

| Alias / legacy | Canonico kebab |
|----------------|----------------|
| `BEST_PRACTICES.md` | [best-practices.md](best-practices.md) |
| `BAD_PRACTICES.md` | (anti-pattern: integrare in best-practices se serve) |
| `PRODUCT_STRATEGY.md` | [product-strategy.md](product-strategy.md) / [strategy.md](strategy.md) |
| `PRODUCT_ROADMAP.md` | [product-roadmap.md](product-roadmap.md) / [roadmap.md](roadmap.md) |
| `PRODUCT_LAUNCH_PLAN.md` | [product-launch-plan.md](product-launch-plan.md) / [launch-plan.md](launch-plan.md) |
| `SPRINT_PLANNING.md` | [sprint-planning.md](sprint-planning.md) |
| `USER_RESEARCH.md` | [user-research.md](user-research.md) |
| `REDUNDANCY_ANALYSIS.md` | [redundancy-report.md](redundancy-report.md), [code-redundancy-audit.md](code-redundancy-audit.md) |
| `METODI_DUPLICATI_ANALISI.md`, `metodi_duplicati_analisi.md` | [metodi-duplicati-analisi.md](metodi-duplicati-analisi.md) |
| `ON-DEMAND-PATTERN.md`, `QMD-SETUP.md`, `PERFORMANCE-OPTIMIZATION.md`, `PROJECT-STRUCTURE.md` | pattern condivisi Themes/on-demand; in Rating usare wiki + questo indice |
| `INDEX.md`, `00-INDEX.md` | **questo file** (`index.md`) |

Convenzione nomi: kebab-case, **senza date** nel filename (eccezione `README.md`).

## Redundancy nota

Esistono stub che puntano a `Themes/docs/shared-components/...` (es. vecchi redirect): se il target è `.gitkeep` o fuori modulo, **non** seguirli — usare i file Rating in tabella sopra o il codice in `app/`.

## Backlink

- [User](../User/docs/README.md) — autori voto  
- [Xot](../Xot/docs/) — `XotBase*`  
- Prompt: [00-start](../../../../bashscripts/docs/prompts/00-start.md) · [57-second-brain](../../../../bashscripts/docs/prompts/57-second-brain.md)
=======
# Rating Module

Sistema di valutazione e rating per la piattaforma con supporto per diverse entità e filtraggio avanzato.

## Overview

Il modulo **Rating** fornisce funzionalità di valutazione polimorfiche:

- ⭐ **Rating System** - Valutazioni numeriche (1-5 stelle) su qualsiasi entità
- 👥 **Gestione Utenti** - Tracking autore rating, prevenzione duplicati
- 📊 **Aggregazioni** - Media voti, conteggi, trending
- 🎨 **Interfaccia Filament** - Gestione admin con Filament 5.x
- 🌐 **Multi-lingua** - Traduzioni IT/EN
- ✅ **PHPStan Level 9** - Compliance statica completa

## Key Features

### Rating Management
- Valutazioni numeriche (1-5 stelle)
- Commenti opzionali per ogni voto
- Relazioni polimorfiche (rate qualsiasi modello)
- Prevenzione voti duplicati per utente
- Update/modifica rating esistente

### Filtering & Analytics
- Filtro per range voti (es. solo 4-5 stelle)
- Ordinamento per rating, data, utenti attivi
- Aggregazioni (media, conteggio, distribuzione)
- Trend detection (rising products)

### User Experience
- Widget di rating visuale
- Responsive design
- Notifiche per nuovi rating
- Rating history per utente

## Architecture

```
Rating/
├── app/
│   ├── Models/
│   │   ├── Rating.php
│   │   └── RatingEnum.php
│   ├── Actions/
│   │   ├── CreateRatingAction.php
│   │   └── UpdateRatingAction.php
│   ├── Filament/
│   │   ├── Resources/
│   │   └── Pages/
│   └── Events/
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── lang/
│   ├── it/
│   └── en/
└── docs/
```

**Base Classes**: `XotBaseModel`, `XotBaseResource`

## Core Components

### Models
- **Rating** - Modello principale per rating
- **RatingEnum** - Valori numerici (1, 2, 3, 4, 5 stelle)
- Relazioni polimorfiche (`rateable`)
- Relation con User (autore del voto)

### Filament Resources
- **RatingResource** - Gestione admin rating
- Filtri per entità, valore, autore
- Bulk actions (approvazione, eliminazione)
- Column per media e conteggio

### Events
- `RatingCreated` - Evento creazione rating
- `RatingUpdated` - Evento aggiornamento rating
- Trigger aggregazioni e cache invalidation

## Implementation Guide

### Quick Start
```bash
# Abilitare il modulo
php artisan module:enable Rating

# Eseguire migrazioni
php artisan migrate

# Seeder dati esempio
php artisan db:seed --class=RatingSeeder
```

### Creazione Rating
```php
$rating = Rating::create([
    'user_id' => $user->id,
    'rateable_type' => Product::class,
    'rateable_id' => $product->id,
    'rating' => 5,
    'comment' => 'Ottimo prodotto!',
]);

// Oppure tramite action
app(CreateRatingAction::class)->execute([
    'user_id' => auth()->id(),
    'rateable_type' => Product::class,
    'rateable_id' => $product->id,
    'rating' => 4,
]);
```

### Query Aggregazioni
```php
// Media rating
$avgRating = Rating::where('rateable_type', Product::class)
    ->where('rateable_id', $productId)
    ->average('rating');

// Distribuzione voti (per histogram)
$distribution = Rating::where('rateable_type', Product::class)
    ->where('rateable_id', $productId)
    ->groupBy('rating')
    ->selectRaw('rating, count(*) as count')
    ->get();
```

## Best Practices

### Data Quality
- Validate rating value in range [1, 5]
- Check user authorization prima di allow rating
- Prevent duplicate rating da stesso user (update existing)
- Sanitize commenti (no spam, no profanity)

### Performance
- Index su `rateable_type`, `rateable_id`, `user_id`
- Cache media rating per entità
- Paginate rating lists (20 per pagina)
- Lazy load commenti dettagliati

### User Experience
- Star UI feedback (hover highlight)
- Validazione real-time
- Success message post-submit
- Loading state durante submit

### Privacy
- Mostrar nome autore opzionale
- Option per rating anonimo
- Respect user privacy settings
- GDPR compliance (cancellazione dati utente)

## Related Modules

- [User Module](../User/docs/) - Autori rating
- [Product Module](../Product/docs/) - Prodotti (se exists)
- [Activity Module](../Activity/docs/) - Activity logging
- [Notify Module](../Notify/docs/) - Notifiche rating
- [Xot Module](../Xot/docs/) - Base classes

## Troubleshooting

**Duplicate rating error**
- Verificare constraint unique su (user_id, rateable_type, rateable_id)
- Implementare find-or-create pattern per updates
- Check model method `hasRatedBy($user)`

**Cache not updating dopo nuovo rating**
- Invalidare cache in event listener
- Verificare cache key pattern
- Force clear: `php artisan cache:clear`

**Rating not visible nel frontend**
- Check visibility query scopes
- Verify eager loading relazioni
- Ensure policy autorizzazione consente read

## Documentation

Vedi anche:
- [README](README.md) - Panoramica
- [PRD](prd.md) - Product requirements
- [Architecture Rules](architecture-rules.md) - Regole architetturali
- [Best Practices](best-practices.md) - Pattern consolidati
- [PHPStan Fixes](phpstan-fixes.md) - Conformità statica

---

**Status**: Active Development  
**PHPStan Level**: Target Level 9  
**Translation**: IT/EN ✅  
**Last Updated**: 2026-05-13
>>>>>>> laraxot/dev
