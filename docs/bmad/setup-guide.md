---
<<<<<<< .merge_file_WBienD
title: "Rating — Setup Guide"
type: note
module: Rating
tags:
  - bmad
  - rating
  - setup
created: 2026-09-28
updated: 2026-09-28
qmd: "rating setup provider config migrate seed test"
related:
  - README.md
  - quick-reference.md
---

# Rating — Setup Guide

> **SUMMARY** — Come si porta il modulo `Rating` in un ambiente funzionante: provider da
> registrare, config, migrazioni, seeders e test. Comandi da eseguire dalla root di `laravel/`.

## 1. Registrazione provider

Dichiarati in `module.json` e in `composer.json` (`extra.laravel.providers`):

- `Modules\Rating\Providers\RatingServiceProvider`
- `Modules\Rating\Providers\Filament\AdminPanelProvider`

`app/Providers/RatingServiceProvider.php` e' una classe di 20 righe che estende
`XotBaseServiceProvider` e non sovrascrive `boot()`/`register()`: il boot del modulo e' tutto
in `Filament/AdminPanelProvider.php` e nella scoperta automatica delle risorse.

## 2. Config

`config/config.php` contiene solo:

| Chiave | Uso |
|--------|-----|
| `name` | nome del modulo |
| `icon` | icona sulla dashboard (`heroicon-o-star`) |
| `navigation_sort` | ordine di navigazione |

Non ci sono chiavi di connessione DB nel modulo: `BaseRating` e `BaseRatingMorph` usano la
connessione standard, mentre le concrete in altri moduli sono su connessioni dedicate
(vedi `RatingContract` docblock).

## 3. Migrazioni

Miglrazioni attive in `database/migrations/`:

| File | Oggetto |
|------|---------|
| `2023_01_01_000000_create_ratings_table.php` | tabella ratings |
| `2023_01_01_000005_create_rating_morph_table.php` | tabella rating_morph |
| `2026_03_12_180000_create_ratings_table.php` | ratings |
| `2026_03_27_000001_add_percentage_to_rating_morph_table.php` | colonna percentage |
| `2026_03_27_000002_add_percentage_to_rating_morph_table_on_rating_connection.php` | percentage su connessione rating |
| `2026_06_16_000003_create_ratings_table.php` | ratings |
| `2026_07_15_120003_create_rating_morph_table.php` | rating_morph |
| `2026_07_27_100005_create_rating_morph_table.php` | rating_morph |

Copie spostate in `database/migrations/_archive_redundant/` e `database/migrations/_bak/`.
Prima di applicare, verificare quali sono idempotenti: piu' file creano la stessa tabella.

Vincoli di progetto: mai `migrate:fresh`, mai `--force`, mai `RefreshDatabase`.

## 4. Factory e seeders

| File | Path |
|------|------|
| `BaseRatingFactory`, `RatingFactory`, `LikeFactory` | `database/factories/` |
| `RatingSeeder`, `RatingMorphSeeder`, `RatingDatabaseSeeder` | `database/seeders/` |

## 5. Rotte

`routes/web.php` e `routes/api.php` contengono solo `declare(strict_types=1);`.
Non esiste superficie HTTP dichiarata dal modulo.

## 6. Test

Da `laravel/`:

```bash
./vendor/bin/pest --filter=Rating
./vendor/bin/pest Modules/Rating
```

Supporto: `tests/Pest.php`, `tests/TestCase.php`, stub in `tests/Fixtures/`
(`HasRatingHostStub.php`, `RatingsHostStub.php`, `RatedModelStub.php`, `OwnedModelStub.php`,
`BaseEditRatingStub.php`, `BaseRatingsTableStub.php`, `LikeableStub.php`).

Nota di progetto: sull'host `10.100.200.15` non si lanciano test (dati sacri).

## 7. Dashboard

`app/Filament/Pages/Dashboard.php`, `app/Filament/Blocks/Rating.php` e
`app/Filament/Widgets/StatsOverview.php` compongono la vista dashboard del modulo; la traduzione
dell'etichetta dashboard e' in `lang/it/admin_panel_provider.php`.
=======
title: "Rating — BMAD Setup Guide"
description: "Setup e configurazione BMAD per il modulo Rating"
module: "Rating"
alias: "rating"
documentation_date: "2026-09-29"
bmad_version: "6.2.0"
---

# Rating — BMAD Setup Guide

## Scopo

Rendere ripetibile e verificabile l'uso del BMAD Method per il modulo Rating.

## Passi di Setup

```bash
# 1. Dipendenze (da laravel/)
composer install

# 2. Variabili d'ambiente
cp .env.example .env
php artisan key:generate

# 3. Attributi schemaless (rating, percentuali, attributi liberi)
#    pacchetto: spatie/laravel-schemaless-attributes
#    verificare che la colonna JSON sia valorizzata sulle tabelle host

# 4. Provider (da composer.json extra.laravel.providers)
#    Modules\Rating\Providers\RatingServiceProvider
#    Modules\Rating\Providers\RouteServiceProvider
#    Modules\Rating\Providers\Filament\AdminPanelProvider

# 5. Cache e asset
composer clear
composer fix-storage
```

Dipendenze runtime: `spatie/laravel-schemaless-attributes`, PHP `^8.3`.

> **Dati sacri**: mai `migrate:fresh`, mai `--force`, mai `RefreshDatabase`.
> Solo migrate additivi. Su host `10.100.200.15` non si lanciano test Pest.

## Cosa è "BMAD" qui (Business Logic)

In questo modulo, BMAD serve a:
- **Garantire correttezza del pivot**: `value` + `note` sono l'unico contratto tra Rating e host
- **Supportare il code review**: la semantica di «altro» (chiave `'other'`, nota obbligatoria)
  è una decisione, va documentata e non reinventata per host
- **Abilitare il debug**: `BettableAggregate` dice in che stato è un host (`to_predict`, `to_rating`)
- **Governare l'evoluzione**: gli host non duplicano il form, usano `HasRatingsTrait`

## Best Practices (Pratiche Giuste)

- Documentare prima di implementare: PRD prima di codice
- Estendere XotBase: modelli da `BaseModel`, pivot da `BaseMorphPivot`
- Estendere le `Base*Resource`, mai Filament diretto
- Actions, non Services: logica in `Actions/` con `execute()`
- PHPStan Level max: nessun `ignoreErrors`
- Traduzioni dai file: mai label hardcoded
- Array PHP: una chiave per riga
- Tipizzare su `RatingContract` / `HasRatingContract`, mai su `BaseRating`

## Bad Practices (Pratiche Sbagliate — Mai Fare)

- Mai estendere Filament direttamente
- Mai silenziare PHPStan
- Mai hardcode label
- Mai creare Services
- Mai modificare `phpstan.neon`
- Mai usare `''` come sentinella per «altro»: collassa a `null` e rompe la nota obbligatoria
- Mai usare `RuleEnum` sulla Select con figli
- Mai duplicare fill/save del pivot negli host: esiste `HasRatingsTrait`

## False Friends (Falsi Amici)

| Termine | Sembra Significare | In Realtà Significa |
|---|---|---|
| **Rating** | Valutazione | Definizione di un insieme di opzioni (con i suoi figli) |
| **RatingMorph** | Relazione | Pivot con `value` + `note` tra rating e host |
| **RuleEnum** | Enum qualunque | Enum di **regole di validazione** (stringhe di Laravel), non di opzioni |
| **BaseRating / BaseRatingMorph** | Classi base | Basi riusabili dai moduli host |
| **HasRating / HasRatingsTrait** | Due trait simili | Il primo espone il rating, il secondo gestisce il form pivot |
| **Service** | Servizio generico | **Vietato** in Xot — usare `Actions` |

## Struttura Directory (Canonical)

- **`app/Actions/`**: `GetCountByModelRatingIdAction`, `GetSumByModelRatingIdAction`,
  `GetRatingOptsByModelAction`, `HasRating/`
- **`app/Models/`**: `BaseRating`, `BaseRatingMorph`, `Rating`, `RatingMorph`,
  `AbstractRatingsHost`, `Like` + `Contracts/` + `Traits/`
- **`app/Aggregates/BettableAggregate/`**: stati `to_predict`, `to_rating`
- **`app/Enums/`**: `RuleEnum`, `SupportedLocale`
- **`app/Filament/`**: `RatingResource`, `RatingMorphResource`, `Base*Resource`,
  `HasRatingResource`, `StatsOverview`, `Blocks/`, `Sections/`, `Concerns/`
- **`database/migrations/`**: `ratings`, `rating_morph` (con `percentage`) — schema incrementale
- **`lang/it/`**: chiavi di traduzione
- **`docs/bmad/`**: questa documentazione

---

*Rating · BMAD Setup Guide · data 2026-09-29*
>>>>>>> .merge_file_rTyJ0w
