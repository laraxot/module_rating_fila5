---
title: "Audit qualita' modulo Rating"
type: story
status: in-review
module: Rating
created: 2026-11-19
updated: 2026-11-19
issues: ["laraxot/base_techplanner_fila5#64"]
tags: [audit, qualita, docs, phpstan, pest]
qmd: "audit qualita story rating"
---

# Audit qualita' — modulo Rating

Story BMAD dell'audit di qualita' coordinato nella issue
[#64](https://github.com/laraxot/base_techplanner_fila5/issues/64).
Ambito: solo `Modules/Rating` (documentazione e `app/`).

## Baseline e risultato

| Verifica | Prima | Dopo |
|---|---|---|
| PHPStan max (`Modules/Rating`) | 0 errori | 0 errori |
| Pest (`Modules/Rating/tests`) | 9 falliti / 4 passati | 9 falliti / 4 passati |
| Occorrenze `mixed` in `app/` | 14 | 13 |

## Documentazione

- File `.md` con data/timestamp nel nome: 2 rinominati, 1 uniti al file canonico
  omonimo (contenuto unico conservato sotto "Contenuto unito da ..."), 0 rimossi perche' vuoti
  o gia' contenuti nel canonico. La data originale e' ora nel frontmatter `created:`.
- Duplicati esatti (contenuto identico) rimossi: 1; tenuta la copia meglio collocata
  (no `archive/`, `raw/`, suffissi `-1`/`_1`, maiuscole o underscore) e link interni aggiornati.
- `docs/index.md` (indice canonico): aggiunta la sezione "Mappa delle cartelle" con link relativi
  a tutte le aree; link rotti agli altri moduli corretti dove la destinazione era determinabile.

## Codice (`app/`)

- `Models/Rating.php`: rimosse 22 righe duplicate dal PHPDoc di classe
- Rimossi file morti: `Models/BaseModel.php.backup-20251015-092511`, `Aggregates/BettableAggregate.to_predict`
- Rimossi `DataObjects/RatingData.php` (resta `Datas/RatingData`) e `Filament/Resources/HasRatingResource/` (RelationManager e StatsOverview orfani, senza Resource e senza riferimenti; restano `Filament/RelationManagers/RatingsRelationManager` e `Filament/Widgets/StatsOverview`)

## Scoperte da gestire (non risolte in questo audit)

- Le 9 failure di `RatingApiTest` sono `QueryException` di schema nel DB di test (ambiente), non analizzate oltre
- Nell'indice restano link rotti verso file mai esistiti o di altri progetti: da rivedere a mano.
- `docs/` contiene ancora `INDEX.md`, `README.md` e `index.md` affiancati (collisione su filesystem
  case-insensitive): da consolidare in un solo indice con decisione condivisa.

## Criteri di accettazione

- [x] PHPStan max a 0 errori senza ignore/baseline
- [x] Nessun `.md` con data nel nome
- [x] Nessun duplicato esatto in `docs/`
- [x] Test Pest non peggiorati
- [ ] Punti aperti sopra risolti
