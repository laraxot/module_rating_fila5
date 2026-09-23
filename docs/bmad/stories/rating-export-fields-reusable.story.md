# Story: rating export fields reusable

**Status**: ready-for-dev
**Modulo**: Rating
**Epic**: metodologia riutilizzabile per esportazione rating

## AC
- [ ] Metodo `getXlsFields` riutilizzabile creato in `Modules/Rating/app/Datas/RatingData.php` (preferenza utente)
- [ ] Metodo accetta `array $data` (con anno e tipo) e restituisce `array<int|string, string>` (path → label)
- [ ] Usa `Rating::withExtraAttributes(['anno' => $anno, 'type' => $type])` per la query
- [ ] Usa `Rating::getClassName()` per risolvere la classe rating (non hardcoded)
- [ ] Integra con `HasRatingsTrait::formFieldLabel()`, `ratingXlsValuePath()`, `ratingValuePath()` (DRY)
- [ ] Gestisce caso senza anno: restituisce array vuoto
- [ ] PHPStan Modules/Rating [OK]
- [ ] PHPStan Modules/IndennitaResponsabilita [OK] (dopo refactoring)
- [ ] Pest verdi su moduli toccati
- [ ] Resource host (IR) refattorizzato per usare il nuovo metodo (chiude #todo)

## Note
- Questo è un componente riutilizzabile (esattamente come individuato per il componente Blade `rating-table`)
- Il metodo può essere chiamato da qualsiasi resource host che ha rating con `extra_attributes` (IR, Ptv, Performance, Progressioni)
- Parametri: `$data` (array dei dati del form), eventualmente `$hostModelClass` o `$type` a seconda del contesto
- `RatingData` è tecnicamente un DTO UI ma l'utente ha espresso preferenza per questo posizionamento
- Second brain: aggiungere regola `rating-data-export-method.md` in `bashscripts/ai/wiki/memories/`
