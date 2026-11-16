---
id: Rating/module-bmad-audit-20260928
title: "Rating: baseline BMAD e analisi completa"
status: ready-for-dev
module: Rating
epic: module-governance
priority: P1
created: 2026-09-28
references:
  - ../architecture/module-boundary.md
  - ../brainstorming/module-opportunities.md
  - ../epics/module-roadmap.md
type: story
updated: 2026-10-07
tags: [docs, rating, bmad]
qmd: "story   rating: baseline bmad rating"
---
# Story: Rating: baseline BMAD

Come manutentore del modulo Rating, voglio una baseline BMAD verificabile, così da poter pianificare lavoro senza confondere ipotesi, WIP e comportamento osservato.

## Acceptance criteria

- [ ] Confermare API pubblica e confini con riferimenti a codice reale.
- [ ] Inventariare i flussi critici e collegarli a test Pest.
- [ ] Misurare PHPStan/Pest nel contesto stabile del modulo.
- [ ] Registrare dipendenze, rischi e decisioni nel modulo.
- [ ] Aggiornare lo stato reale in `docs/sprint-status.yaml`.

## Task

- [ ] Revisione architettura.
- [ ] Brainstorming con stakeholder.
- [ ] Decomposizione epic in story più piccole.
- [ ] Quality gate e second-brain write-back.

## Audit 2026-11-16

Audit statico source-first eseguito su worktree corrente (dettaglio esteso in
`docs/bmad/audits/rating-audit.md` e `docs/bmad/audit.md`, non duplicato qui).
Attenzione: repo del modulo ha 21 cancellazioni docs/ staged e file
`docs/bmad/audit.md`/`audits/` untracked di lavoro parallelo — non sovrascritti.

### Struttura misurata

- `app/`: 76 file PHP — 19 modelli, 3 Action (sotto `Actions/HasRating`),
  0 Service, 2 Contract, 2 Enum, 4 Policy (`app/Models/Policies`),
  1 widget (`Filament/Widgets/StatsOverview`).
- Filament: 40 file — 4 Resource (`RatingResource`, `RatingMorphResource`,
  `HasRatingResource` base, `SettingPage`), pagine/schemi/tabelle e relation
  manager; gerarchia corretta `Base*Resource extends XotBaseResource`,
  `Base*Page extends XotBase*Record`, `BaseChildrenRelationManager extends
  XotBaseRelationManager`.
- `database/migrations`: 12 file, di cui 4 in sottodirectory
  `_archive_redundant/` e `_bak/` (8 attive).
- `tests/`: 42 file — 30+ file di test reali (Unit/Feature) + `tests/Fixtures/`
  con stub e probe.
- `routes/web.php` e `routes/api.php` stub vuoti; `app/Http`, `app/Console`
  contengono solo `.gitkeep`/`_components.json` (directory vuote).
- Lang: `it` 23 file, `en` solo `setting.php` — 22 file senza equivalente.

### Findings

1. **[P1] Migrazioni archiviate dentro `database/migrations/`** —
   `_archive_redundant/2023_01_01_000000_create_ratings_table.php` e
   `_archive_redundant/2026_03_12_180000_create_ratings_table.php` più 2 file
   in `_bak/` restano sotto il path caricato dal migrator (sottodirectory
   incluse). Rischio duplicate-table se il migrator non esclude le
   sottodirectory: verificare loader del modulo e spostare gli archivi fuori
   da `database/migrations` o marcarli esplicitamente.
2. **[P2] Codice morto/sospetto in `app/`** —
   `Filament/Actions/Table/BetTableAction.php` sembra demo (tooltip
   `rating:txt.bet`, campo `TextInput::make('aa')`, label `''`);
   `Filament/Concerns/DecoratesRatingFormFieldsPhpstanProbe.php` e
   `Models/RatingPhpstanTraitProbe.php` sono probe PHPStan collocati in
   `app/` (verificare se referenziati o rimovibili).
3. **[P2] Trait dichiarati morti ma presenti** — `Models/Traits/HasRating.php`
   e `Models/Traits/RatingTrait.php` portano `@phpstan-ignore trait.unused`
   con nota "zero consumer verificato 2026-09-01": decidere rimozione o
   documentare eccezione.
4. **[P3] i18n quasi assente in `en`** — 22 file lang `it` senza equivalente
   `en`; se `en` è locale supportato, le UI inglesi ricadranno sulle chiavi
   mancanti. Verificare `SupportedLocale` e fallback.
5. **[P3] `@phpstan-ignore` puntuali** — 9 occorrenze in `app/` (es.
   `BaseRating.php:179` ignore `return.type` su `morphTo`); accettabili se
   motivate, da rivedere in cleanup.
6. **[OK] PHPStan level max: 0 errori** su `Modules/Rating` (2026-11-16,
   `--error-format=raw`, exit 0). Compliance Filament buona: nessun
   `->label()/->placeholder()/->helperText()` hardcoded rilevante (unico
   `->label('')` in `BetTableAction`, `->helperText('')` in
   `DecoratesRatingFormFields`), nessun `Filament\Forms\Form` legacy, nessun
   marker di merge in codice.
7. **[P3] Documentazione con date nel nome** — 13 `.md` con data/timestamp
   sotto `docs/` (es. `docs/phpstan-fixes-2026-01.md`,
   `docs/bmad/stories/*-2026-09-*.story.md`,
   `docs/bmad/redundancy-audit-2026-05-21.md`): violazione convenzione nomi
   stabili; valutare rinomina con redirect documentale.

### Test

- 183 match `test(`/`it(` distribuiti su ~30 file test; nessun
  `expect(true)->toBe(true)` rilevato.
- Copertura buona su Unit (trait HasRatings, policy, Datas, blocco Filament);
  `Feature/` contiene solo `RatingApiTest.php` — flussi Filament reali
  (create/edit rating, morph, relation manager) coperti solo via stub.
- `tests/Fixtures/` ricco di stub (`RatingsHostStub`, `BaseRatingsTableStub`,
  `LikeableStub`): classificare come fixture, non come test.

### Rischi

- Migrazioni duplicate in sottodirectory: potenziale fallimento deploy o
  drift schema se loader cambia.
- Repo con 21 docs cancellate staged da altro agente: coordinare prima di
  qualunque cleanup documentale.
- `BetTableAction` esposta a runtime se registrata: campo `aa` senza
  validazione — verificare registrazione prima di rimozione.

### Next steps (priorizzati)

1. Story: spostare `_archive_redundant/` e `_bak/` fuori da
   `database/migrations/` (o verificare esclusione loader) — P1.
2. Story: rimuovere o finalizzare `BetTableAction` e i probe in `app/`.
3. Story: decisione sui trait `HasRating`/`RatingTrait` (rimozione o uso).
4. Completare lang `en` o ridurre `SupportedLocale` di conseguenza.
5. Aggiungere Pest Feature per `RatingResource` create/edit e
   `ChildrenRelationManager`.
6. Normalizzare i 13 `.md` con data nel nome (kebab-case stabile).

