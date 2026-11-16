---
title: "Audit approfondito modulo Rating"
type: audit
status: review
updated: 2026-11-16
module: Rating
qmd: "audit approfondito Rating rating_morph orfani foreign key migration duplicate policy trait morto probe PHPStan Pest"
---

# Audit approfondito — Rating

SSoT dei finding del modulo. Sintesi: [audit.md](../audit.md) · ECC: [rating-ecc-audit.md](../../ecc/rating-ecc-audit.md) · Story: [module-bmad-audit.story.md](../stories/module-bmad-audit.story.md) · Piano: [piano-miglioramento.md](../piano-miglioramento.md).

## Perché esiste (business)

Rating dà a ogni scheda (Performance, Progressioni, Indennità) lo **stesso modo** di raccogliere punteggi e note, via relazione polimorfica (`rating_morph`) e `HasRatingsTrait` ([HasRatingsTrait.php](../../../app/Models/Traits/HasRatingsTrait.php), 770 righe). È self-contained: non importa nessun altro modulo di dominio (solo Xot 63, Media 1). Il rischio è nel dato: un morph senza vincoli lascia punteggi orfani o duplicati che falsano il riparto.

## Metodo

Source-first: `find`/`rg` (2026-11-16), lettura dei file citati, PHPStan e Pest eseguiti.

## Inventario misurato

| Area | N | Nota |
|---|---:|---|
| PHP `app/` | 76 | `strict_types` mancante: 0 |
| Test PHP / `*Test.php` | 42 / 30 | unit 29, feature 1; ratio 0.55; 0 test "coverage" |
| Models top-level | 9 | 19 con Traits/Policies/Contracts |
| Policy | 4 | coppia `Base*`/concreta per `Rating` e `RatingMorph` |
| Resource / Pages / Widgets | 4 / 11 / 2 | |
| Actions (`app/Actions`) | 3 | purpose citava 34 |
| Services | 0 | |
| Migration (radice) + archiviate | 8 + 4 | `_archive_redundant/` e `_bak/` non caricate (loader non ricorsivo) |
| Lang IT / EN (file) | 25 / 1 | parità EN 4% |
| `@phpstan-ignore` in `app/` | 3 | tutti motivati |
| `label('...')` hardcoded | 0 | |
| Estensioni dirette Filament | 0 | i widget estendono `XotBase*` |
| Marker conflitto | 0 | |
| Docs `.md` / maiuscole / con data | 602 / 36 / 13 | |

## Finding

### P0

Nessuno confermato.

### P1

| ID | Finding | Evidenza | Perché conta |
|---|---|---|---|
| RAT-P1-01 | **`rating_morph` senza integrità**: `rating_id` nullable senza FK, `nullableMorphs('model')` (tipo e id nullable), nessun unique su (model, rating, user), nessun `morphMap`/cascade alla cancellazione del modello valutato (`rg morphMap\|enforceMorphMap` = 0; l'unico `deleting` è in `HasLikes`). | [2026_07_27_100005_create_rating_morph_table.php:24-26](../../../database/migrations/2026_07_27_100005_create_rating_morph_table.php), [HasLikes.php:74](../../../app/Models/Traits/HasLikes.php) | Doppio voto per lo stesso criterio e punteggi orfani falsano medie e riparto; il database non può impedirlo. Rischio già dichiarato in [purpose.md](../purpose.md), mai mitigato. |
| RAT-P1-02 | **Lo schema è definito 3+3 volte**: `create_ratings_table` in [2023_01_01_000000](../../../database/migrations/2023_01_01_000000_create_ratings_table.php), [2026_03_12_180000](../../../database/migrations/2026_03_12_180000_create_ratings_table.php), [2026_06_16_000003](../../../database/migrations/2026_06_16_000003_create_ratings_table.php); `create_rating_morph_table` in [2023_01_01_000005](../../../database/migrations/2023_01_01_000005_create_rating_morph_table.php), [2026_07_15_120003](../../../database/migrations/2026_07_15_120003_create_rating_morph_table.php), [2026_07_27_100005](../../../database/migrations/2026_07_27_100005_create_rating_morph_table.php). Idempotenti per `hasTable`/`hasColumn`, ma la tabella reale dipende dall'ordine di esecuzione. | `rg -c 'hasTable\|hasColumn' database/migrations` | Su un DB nuovo vince la prima; su uno esistente nessuna: il vincolo del P1-01 non può essere aggiunto "in un posto". Migrate additivo soltanto: la correzione è una migration nuova, non la modifica delle vecchie. |

### P2

| ID | Finding | Evidenza |
|---|---|---|
| RAT-P2-01 | Trait morti: `RatingTrait` e `HasRating` hanno zero consumer (dichiarato con `@phpstan-ignore trait.unused`); l'unico uso di `HasRating` è un model-sonda. | [RatingTrait.php:20](../../../app/Models/Traits/RatingTrait.php), [HasRating.php:14](../../../app/Models/Traits/HasRating.php) |
| RAT-P2-02 | `RatingPhpstanTraitProbe` in `app/Models` (namespace di produzione): tabella `rating_phpstan_trait_probe` inesistente, `$guarded = []`. Esiste solo per far analizzare il trait a PHPStan. | [RatingPhpstanTraitProbe.php:10-17](../../../app/Models/RatingPhpstanTraitProbe.php) |
| RAT-P2-03 | Residui in `app/`: `BaseModel.php.backup-20251015-092511`, `Traits/RatingTrait.php.old`, `Aggregates/BettableAggregate.to_rating`, `Datas/RatingData.php.bak`, `Datas/RatingMorphData.php.bak`. In radice: `README.md.old`, `composer.json.tmp`, `ruvector.db` (binario **tracciato** da git), `CHANGELOG.MD`+`CHANGELOG.md`+`changelog.md`, `LICENSE.md`+`license.md`. |
| RAT-P2-04 | Policy duplicate: `RatingMorphPolicy` ≡ `BaseRatingMorphPolicy` (differisce solo `abstract`), idem `RatingPolicy`/`BaseRatingPolicy`. `isOwner` confronta con `===` `user_id`/`matr`: un tipo diverso (stringa vs int) nega in silenzio. | [RatingMorphPolicy.php:88,95](../../../app/Models/Policies/RatingMorphPolicy.php), [BaseRatingMorphPolicy.php:88,95](../../../app/Models/Policies/BaseRatingMorphPolicy.php) |
| RAT-P2-05 | `@phpstan-ignore return.type` su `morphTo`. | [BaseRating.php:179](../../../app/Models/BaseRating.php) |
| RAT-P2-06 | Docs: purpose cita "34 Action, 15 Widget" (reali 3 + 2) e `RatingMorphTrait` (non esiste, `rg`); `epics.md`/`decision-log.md` erano template, `architecture.md` uno stub "se applicabile"; 36 `.md` con maiuscole (`bmad/BEST_PRACTICES.md`, `bmad/best-practices.md`, `bad_practices.md`/`BAD_PRACTICES.md`/`bad-practices.md`…), 13 con data nel nome, `README.md.old`/`readme-en.md`. |
| RAT-P2-07 | Parità lingue: 1 file EN contro 25 IT. |

## Verificato OK

- PHPStan livello max, nessun ignore non motivato; nessun `dd`/`env()`; nessuna chiamata a `property_exists()` (le 4 occorrenze sono commenti in [RatingMorphPolicy.php:86,93](../../../app/Models/Policies/RatingMorphPolicy.php) e nella `Base`).
- `TestCase` usa sqlite condiviso e transazioni: niente `RefreshDatabase`/`migrate:fresh` ([TestCase.php:16,38](../../../tests/TestCase.php)).
- Modulo senza dipendenze da altri verticali.
- Zero label hardcoded e zero estensioni dirette di Filament.

## Gate (2026-11-16)

```bash
cd laravel
php -d memory_limit=4G ./vendor/bin/phpstan analyse Modules/Rating --no-progress   # exit 0
timeout 420 ./vendor/bin/pest Modules/Rating/tests --no-coverage --compact          # exit 124, nessun output
```

- **PHPStan Rating: 0 errori** (level max, `ignoreErrors` vuoto, tests inclusi).
- **Pest Rating: SKIP documentato.** Run completo: timeout 420 s senza output; un singolo test ([BaseRatingModelTest](../../../tests/Unit/BaseRatingModelTest.php)) idem >150 s a 1% CPU. Causa probabile: `DB_HOST=10.100.200.53:3306` non raggiungibile (`/dev/tcp` verificato) e load medio ~95. Nessun DB distruttivo usato; host non produttivo.

## Prossimi passi

[epics.md](../epics.md): Epic A (integrità `rating_morph`, migration additiva nuova) → B (pulizia residui) → C (docs).
