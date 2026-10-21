---
title: "Rating — PHPStan cluster A 2026-10-21"
type: story
status: done
module: Rating
epic: quality-fleet
story_id: "rating-phpstan-clusterA-20261021"
track: quality/fleet
created: 2026-10-21
updated: 2026-10-21
tags: [phpstan, cluster-a, swarm, quality, rating]
qmd: "phpstan cluster a rating zero errori level max verifica 2026-10-21"
related:
  - ../../../../Xot/docs/bmad/stories/phpstan-modules-swarm-20261021.story.md
  - ./2026-10-21-phpstan-fix-rating.story.md
  - ../filament-blueprint.md
---

# Rating — PHPStan cluster A 2026-10-21

## Contesto

Cluster A dello swarm PHPStan (Rating, Activity, Media), coordinato da
`Xot/docs/bmad/stories/phpstan-modules-swarm-20261021.story.md`. Ordine di
lavorazione del subagent: Activity, Media, Rating. Rating è la piattaforma
dei contratti `RatingContract`, `BaseRating`, `BaseRatingMorph` e delle basi
Filament (`BaseRatingForm`, `BaseRatingsTable`, `BaseListRatings`) estese dai
moduli di dominio.

## Errori prima/dopo

| Gate | Prima | Dopo |
|------|-------|------|
| `phpstan analyse Modules/Rating` (level max, cache reale) | 0 | 0 |
| `phpstan analyse Modules/Rating --debug` (cache ignorata) | 0 | 0 |

Comando eseguito da `laravel/`:

```bash
nice -n 10 php -d memory_limit=2G ./vendor/bin/phpstan analyse Modules/Rating --debug --no-progress --error-format=table
```

Nessun errore, nessun file `app/` modificato. La configurazione root non ha
baseline (`phpstan.neon` include il commento `phpstan-baseline.neon` disattivato)
e non esistono ignore specifici per Rating nel file analizzato.

## Fix e perché

Nessun fix necessario. La story precedente `2026-10-21-phpstan-fix-rating.story.md`
(ancora `ready-for-dev`) elencava errori su `RatingData`, `RatingsColumn`,
`BaseRatingForm`, `BaseRating`/`BaseRatingMorph`: il codice attuale è già
allineato ai contratti (cast, generics `Builder<TModel>`, tipi di ritorno),
quindi la verifica fresh non rileva regressioni. Non sono stati introdotti
ignore, baseline o indebolimenti di tipo.

## Test

Pest del modulo tentato con `./vendor/bin/pest Modules/Rating --no-coverage`:
suite di 29 file, interrotta per timeout dopo 15 minuti. Il primo test
eseguito singolarmente (`tests/Unit/DecoratesRatingFormFieldsTest.php`) fallisce
prima delle asserzioni per `Modules\Xot\tests\Support\TestDatabaseGuard`:
le connessioni configurate puntano a database non usa-e-getta (`ptv_lara`,
`badge`, `performance`, ...), non a `*_test`. È un limite di ambiente
(`.env.testing` sovrascrive solo la connessione primaria), non del codice del
modulo. Nessuna modifica al codice: il gate Pest resta informativo e va
rieseguito quando l'ambiente di test espone tutte le connessioni `_test`.

## Lock

`bashscripts/lock/lock.sh laravel/Modules/Rating phpstan-clusterA-20261021 swarm-clusterA`
acquisito il 2026-10-21, rilasciato a fine verifica.
