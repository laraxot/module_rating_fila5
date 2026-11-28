---
title: "Rating Module"
type: note
tags: [rating, documentation, module]
created: 2026-05-13
updated: 2026-11-17
qmd: "rating modulo documentazione voti polimorfici utenti aggregazioni filament multilingua phpstan"
issues:
  - "https://github.com/laraxot/platform/issues/272"
discussions:
  - "https://github.com/laraxot/platform/discussions/273"
---

# Rating Module

Sistema di valutazione polimorfico per entità diverse, con filtraggio e aggregazioni.

## Funzionalità

- Rating numerici 1–5, commenti opzionali e modifica del voto esistente.
- Relazioni polimorfiche, autore del voto e prevenzione dei duplicati.
- Filtri, media, conteggi, distribuzione e trend.
- Interfaccia admin Filament, responsive UI e traduzioni IT/EN.
- Validazione del valore, autorizzazione, privacy/GDPR e indici su tipo/id/autore.

## Architettura

Il modulo usa `XotBaseModel` e `XotBaseResource`, `HasRating`/`HasRatingContract` sui modelli rateable e Actions per lettura e aggregazione. Le relazioni principali sono `Rating`, `RatingMorph` e il pivot polimorfico; le risorse Filament gestiscono rating, filtri e aggregazioni.

Per i dettagli PHPStan e i contratti consultare:

- [PHPStan fixes](phpstan-fixes.md)
- [Generic MorphToMany troubleshooting](wiki/troubleshooting/phpstan-generic-limitation-morphtomany.md)
- [Best practices](best-practices.md)
- [Architecture](architecture.md)
- [Contracts](contracts/README.md)
- [ADR](adr/README.md)

## Moduli correlati

- [User](../../User/docs/)
- [Activity](../../Activity/docs/)
- [Notify](../../Notify/docs/)
- [Xot](../../Xot/docs/)
- Product, quando presente nell'applicazione.

## Documentazione

- [README](README.md)
- [BMAD](bmad/index.md)
- [LLM Wiki](llm-wiki/index.md)
- [Roadmap](roadmap/README.md)
- [Wiki](wiki/index.md)
- [Redundancy audit](redundancy-audit.md)

## Regole architetturali

- **No Http Controllers:** usare Folio + Actions per gli endpoint HTTP e Filament per l'admin.
- Estendere le basi Xot, non Filament direttamente.
- Non aggiungere `@phpstan-ignore` per nascondere errori; verificare con PHPStan max.
- Test nel modulo e database di test dedicato; mai `RefreshDatabase`.

## Verifica rapida

```bash
php artisan module:enable Rating
php artisan migrate
```

Per la configurazione corrente e i comandi di qualità usare la documentazione del modulo e il harness del repository.
