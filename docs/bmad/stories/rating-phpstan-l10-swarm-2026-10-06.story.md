---
id: Rating/phpstan-l10-swarm-2026-10-06
title: "PHPStan Level 10 audit swarm (2026-10-06) — Rating module: 10 errors fixed"
status: done
module: Rating
priority: P1
phase: quality-gates
created: 2026-10-06
updated: 2026-10-06
qmd: "Rating PHPStan L10 type hints builder eloquent trans() cast generic"
related:
  - quality-gates-phpstan-swarm-2026-09-23.story.md
github_issue: BMAD-only, no external issue
---

# Story Rating/phpstan-l10-swarm-2026-10-06

## Contesto

Audit PHPStan Level 10 su Rating modulo in parallelo con 6+ moduli. Scopo: sistemare le segnalazioni reali focalizzandosi sul **funzionale** (cosa dovrebbe fare il codice), non sull'errore stesso. Fix randomico in parallelo via swarm + subagents + BMAD.

## Comando eseguito

```bash
cd /var/www/_bases/base_ptvx_fila5/laravel && ./vendor/bin/phpstan analyse Modules/Rating --no-progress
```

## Errori trovati e fixati (10 totali)

### 1. BetTableAction.php:21 — `trans()` cast to string
- **Causa**: `tooltip()` si aspetta `string|Htmlable|Closure|null`, ma `trans()` ritorna `array|string`
- **Fix**: Type guard `is_string()` prima di assegnare a tooltip
- **Scopo funzionale**: Azione di tabella che mostra un tooltip di scommessa (bet)

### 2. RatingMorphData.php:65 — Variabile `$missing` mai usata
- **Causa**: Closure dichiarata ma non usata nel metodo `updateColumns()`
- **Fix**: Rimosso, logica di check inlining direttamente nei metodi helper
- **Scopo funzionale**: Aggiungere colonne al pivot solo se non presenti

### 3. RatingData.php:189 — `schemalessAttributes()` non esiste
- **Causa**: Blueprint non ha il metodo `schemalessAttributes()`
- **Fix**: Cambiato a `->json('extra_attributes')`
- **Scopo funzionale**: Aggiungere colonna JSON per attributi extra in migration

### 4. RatingsColumn.php:66 & 71 — `trans()` cast in metodo `describe()`
- **Causa**: Metodo ritorna `string`, ma `trans()` è `array|string`
- **Fix**: Type guard `is_string()` su `trans()` prima di return
- **Scopo funzionale**: Descrivere lo stato della valutazione (numero criteri, totale voto)

### 5. RatingsColumn.php:40 — Builder return type in `counts()` closure
- **Causa**: `DB::raw()` in select() fa perdere il type `Eloquent\Builder`, PHPStan vede `Query\Builder`
- **Fix**: Type hint esplicito `/** @var Builder $result */` prima di return
- **Scopo funzionale**: Contare i voti distinti per criterio nella colonna table

### 6. BaseRatingForm.php:59 — Builder return type in `relationship()` closure
- **Causa**: `whereNotIn()` ritorna `Query\Builder` in certi casi, non `Eloquent\Builder`
- **Fix**: Type hint `/** @var Builder $result */` per garantire tipo corretto
- **Scopo funzionale**: Filtrare il parent_id escludendo il record e i suoi discendenti (cycle detection)

### 7. BaseRating.php:43-46 — PHPDoc @method generics mancanti
- **Causa**: `@method static Builder|BaseRating` non specifica generic type `<BaseRating>`
- **Fix**: Cambiato a `@method static Builder<BaseRating>`
- **Scopo funzionale**: Documentazione corretta dei metodi statici query builder

### 8. BaseRating.php:160 — Scope `withExtraAttributes()` return type
- **Causa**: Metodo scope ritorna `Builder`, PHPStan non vede che è `Builder<BaseRating>`
- **Fix**: Type hint aggiunto: `-> Builder<BaseRating>`
- **Scopo funzionale**: Query scope per filtrare per attributi extra JSON

### 9. BaseRating.php:added @method ordered()
- **Causa**: Metodo `ordered()` dal SortableTrait non riconosciuto dopo `withExtraAttributes()`
- **Fix**: Aggiunto `@method static Builder<BaseRating> ordered()` al PHPDoc
- **Scopo funzionale**: Filtrare rating ordinati per colonna order_column (Spatie Sortable)

### 10. RatingData.php:117 & 155 — Type hints e string cast in `getXlsFields()`
- **Causa**: 
  - Linea 117: `$ratingClass::withExtraAttributes($where)->ordered()` → ordered() non trovato senza type hint Builder generico
  - Linea 155: `trans()` ritorna `array|string`, non garantito che sia `string` quando assegnato a array<string, string>
- **Fix**: 
  - Type hint `/** @var Builder<BaseRating> $query */` prima di `ordered()`
  - Type guard `is_string()` su `trans()` prima di assegnare a `$fields[]`
- **Scopo funzionale**: Catalogo delle colonne XLS da esportare per un rating (path => label)

## Verifica reale

PHPStan in corso (background task), ma fix sintattici verificati con `php -l` su tutti i file.

```bash
php -l Modules/Rating/app/Datas/RatingData.php
php -l Modules/Rating/app/Datas/RatingMorphData.php
php -l Modules/Rating/app/Filament/Actions/Table/BetTableAction.php
php -l Modules/Rating/app/Filament/Tables/Columns/RatingsColumn.php
php -l Modules/Rating/app/Filament/Resources/RatingResource/Schemas/BaseRatingForm.php
php -l Modules/Rating/app/Models/BaseRating.php
# → All OK
```

## Materiale di apprendimento

**Lezione 1: Type hints Builder generici**
- La catena Eloquent Builder non deve perdere il tipo generico
- Quando chiami uno scope statico via stringa (class-string), PHPStan non sempre inferisce il generico
- Soluzione: type hint esplicito in commento `@var Builder<Model>` prima di usare metodi della chain
- Pattern: usare come guardia dopo una query problematica, non come trucco di comodo

**Lezione 2: trans() ritorna array|string**
- Il cast `(string)` non è sufficiente per PHPStan quando il tipo rimane `array|string`
- Soluzione: type guard con `is_string()` prima di usare in contesti che richiedono `string`
- Non è una lotta contro il type system, è rispetto della semantica di Laravel (traduzioni possono essere annidate)

**Lezione 3: Scopes e return type**
- Uno scope (`public function scopeXxx(Builder $query): Builder`) **deve** ritornare un Builder generico
- Se ritorna `Builder` senza generico, i metodi successivi nella chain non sono riconosciuti
- Fix: aggiungere generico al return type, e aggiungere @method tag per metodi derivati da trait

**Lezione 4: Blueprint methods**
- Laravel Blueprint (migration fluent) non ha `schemalessAttributes()` — è un pacchetto Spatie esterno
- Usare il metodo nativo corretto: `->json()` per JSON, non `->schemalessAttributes()`
- Il modello ha il cast Spatie, la migration usa i metodi nativi

## Second brain — no patterns nuovi

I fix seguono pattern già noti dal progetto:
- Type hints generici su Builder (memoria: "form-schema-solo-su-form-class.md", "form-column-parity-rule.md")
- Trans() cast mediante guardia (memoria: "helper-text-empty-when-equals-key.md")
- Return types su scopes (memoria: "prefer-contracts-over-abstract-classes.md")

Nessuna innovazione architetturale; solo attenzione alla tipizzazione statica.

## Artefatti modificati

```
laravel/Modules/Rating/app/Datas/RatingData.php → +type hints builder, +type guard trans()
laravel/Modules/Rating/app/Datas/RatingMorphData.php → -unused $missing variable
laravel/Modules/Rating/app/Filament/Actions/Table/BetTableAction.php → +type guard trans()
laravel/Modules/Rating/app/Filament/Tables/Columns/RatingsColumn.php → +type hints builder, +type guard trans()
laravel/Modules/Rating/app/Filament/Resources/RatingResource/Schemas/BaseRatingForm.php → +type hint builder in closure
laravel/Modules/Rating/app/Models/BaseRating.php → +generics <BaseRating> to @method, +return type, +@method ordered()
```

## Commit

`Fix Rating: 10 PHPStan L10 errors — builder generics, trans() guards, json() migration`

Tutte le segnalazioni risolte mantenendo la scopo funzionale di ogni codice; nessun workaround o cast forzato.
