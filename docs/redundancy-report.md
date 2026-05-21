# Redundancy Report — Modulo Rating

> Generato: 2026-05-21 | Analisi automatica deep-scan

## Problemi Trovati

### 1. 🟠 BaseMorphPivot NON estende XotBaseMorphPivot

**File**: `app/Models/BaseMorphPivot.php`

```php
// ATTUALE (NON conforme)
abstract class BaseMorphPivot extends MorphPivot
{
    use Updater;
}

// CORRETTO
abstract class BaseMorphPivot extends XotBaseMorphPivot {}
```

### 2. 🟠 BaseRating — Duplicato in Xot

**File**: `app/Models/BaseRating.php`

Esiste una copia in `Modules/Xot/app/Models/BaseRating.php`. Rating è il modulo canonico per questo modello.

**Azione suggerita**: Eliminare la copia in Xot. Tutti gli import dovrebbero puntare a `Modules\Rating\Models\BaseRating`.

### 3. 🟡 EventServiceProvider — Non usa XotBaseEventServiceProvider

**File**: `app/Providers/EventServiceProvider.php`

Estende `BaseEventServiceProvider` (Laravel) invece di `XotBaseEventServiceProvider`.

## Riepilogo

| Priorità | Problema | Stato |
|----------|----------|-------|
| 🟠 | BaseMorphPivot non conforme | Da risolvere |
| 🟠 | BaseRating duplicato in Xot | Xot da pulire |
| 🟡 | EventServiceProvider inconsistente | Da standardizzare |
