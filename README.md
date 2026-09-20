<<<<<<< HEAD
# ⭐ Rating

[![Stars](https://img.shields.io/github/stars/laraxot/module_rating_fila5?style=plastic&color=yellow)]()
[![Forks](https://img.shields.io/github/forks/laraxot/module_rating_fila5?style=plastic&color=green)]()
[![Issues](https://img.shields.io/github/issues/laraxot/module_rating_fila5?style=plastic&color=red)]()
[![License](https://img.shields.io/github/license/laraxot/module_rating_fila5?style=plastic&color=blue)]()
[![Last Commit](https://img.shields.io/github/last-commit/laraxot/module_rating_fila5?style=plastic&color=purple)]()
[![Release](https://img.shields.io/github/v/release/laraxot/module_rating_fila5?style=plastic&color=orange&display_name=release)]()
[![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=for-the-badge)](https://php.net/)
[![Filament](https://img.shields.io/badge/Filament-5-ffab00?style=for-the-badge)](https://filamentphp.com/)
[![Laravel](https://img.shields.io/badge/Laravel-13-red?style=for-the-badge)](https://laravel.com/)
[![Architecture](https://img.shields.io/badge/Architecture-Modular-purple?style=plastic)]()
]()

> **Sistema di valutazioni e feedback**  
> Rating, voti, likeable traits e sistemi di valutazione flessibili.

## 🎯 La Visione

Crediamo che il software debba essere **chiaro, modulare e potente**. Ogni modulo è stato pensato per risolvere problemi reali con soluzioni eleganti.

## Perché esiste questo modulo?

**Rating, voti, likeable traits e sistemi di valutazione flessibili.**

In un mondo dove la complessità è l'avere, abbiamo scritto codice semplice. Questo modulo non è solo una libreria: è una **promessa di qualità** mantenuta.

## 🧘 I Principi Zen (e la nostra filosofia)

1. **Semplicità vince sulla complessità** - Il codice chiaro è più potente di mille righe di commenti.
2. **Modulare è dare vita** - Ogni pezzo può vivere da solo, ma insieme diventa un universo.
3. **Documentare è onniscienza** - La mancanza di documentazione è la paura del futuro.
4. **Testare è fidarsi** - Non fidarsi del proprio codice è fidarsi del caos.
5. **Rifattorizzare è crescere** - Lentamente, incrementalmente, diventiamo migliori.

## 💎 Le sue Superpoteri

- **Architettura modulare** - Separazione netta tra logica di business e presentazione
- **PHPStan Level 10** - Massima sicurezza tipizzazione
- **PSR-12** - Codice che parla lo stesso linguaggio del mondo
- **Filament 5** - Admin panel d'eccellenza
- **XotBase** - Pattern consolidati che funzionano

## 📖 Documentazione

| Lingua | Link |
|--------|------|
| 🇮🇹 Presentazione | Questo file (`README.md`) |
| 🇬🇧 Business card | [docs/readme-en.md](./docs/readme-en.md) |
| 📚 Wiki tecnica | [./docs/wiki/](./docs/) |
| 🎯 Esempi | [docs/examples/](./docs/examples/) |

## 🔧 Tecnologie chiave

**Stack principale:** Laravel 13, Filament 5, XotBase

**Keywords:** Ratings, Reviews, Stars

## 🚀 Pronte all'uso

Importa, installa, configura. Il resto ci penseremo noi.

---

**Modulo** `Rating` · **Laraxot** · PHPStan 10 · Filament 5
=======
# ⭐ Rating — il modulo che misura senza uno schema fisso

<<<<<<< HEAD
[![PHP](https://img.shields.io/badge/PHP-%5E8.3-777BB4.svg)](composer.json)
[![Laravel](https://img.shields.io/badge/Laravel-%5E13.0-FF2D20.svg)](../../composer.json)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%20max%2C%200%20errori-brightgreen.svg)](../../phpstan.neon)
[![strict_types](https://img.shields.io/badge/declare-strict__types%3D1-informational.svg)](#)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
=======
[![Domain-Rating](https://img.shields.io/badge/Domain-Polymorphic%20Rating-FF6F00.svg)](#)
[![Laravel 12](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com/)
[![Filament 5](https://img.shields.io/badge/Filament-5-ffab00.svg)](https://filamentphp.com/)
[![PHP 8.4+](https://img.shields.io/badge/PHP-8.4+-777BB4.svg)](https://php.net/)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-Level%2010-brightgreen.svg)](https://phpstan.org/)
[![PSR-12](https://img.shields.io/badge/Code-PSR--12-blue.svg)](https://www.php-fig.org/psr/psr-12/)
[![Strict Types](https://img.shields.io/badge/PHP-strict__types-1-informational.svg)](#)
[![Laraxot Modules](https://img.shields.io/badge/Architecture-Modular-purple.svg)](#)
[![Rating Module](https://img.shields.io/badge/Module-Rating-008758.svg)](#)
>>>>>>> laraxot/dev

> Non ogni valutazione ha gli stessi campi. Un rating su un servizio, uno su
> una persona, uno su un fornitore hanno forme diverse — Rating esiste per
> gestirle tutte senza una migration diversa per ognuna.

Badge verificati l'1 settembre 2026 con `phpstan analyse Modules/Rating` (0
errori, `level: max`). Rilanciabile: `cd laravel && ./vendor/bin/phpstan analyse Modules/Rating`.

---

## Scopo e confini

Rating è un modulo di piattaforma, non una foglia: **10 classi fuori dal modulo
estendono `BaseRating` o `BaseRatingMorph`** (Ptv, Performance, Progressioni,
IndennitaResponsabilita, IndennitaCondizioniLavoro) e `Modules/Ptv/app/Models/BaseScheda.php:111`
compone `HasRatingsTrait`. Due tabelle sole: `ratings` (il criterio, schemaless) e
`rating_morph` (il voto, polimorfo). La direzione delle dipendenze è pulita — 38 file
toccano Xot, 2 Media, **zero** un modulo di dominio.

I confini rotti stanno nel Filament e nei modelli: 5 classi `Tables/` per 2 Resource (due
mai risolte, vive solo nei test; `RatingsTable` ricopia le 9 colonne di `BaseRatingsTable`
invece di estenderla), 2 `RatingsRelationManager` che estendono Filament direttamente —
le uniche violazioni di `XotBase*` fra Activity, Job e Rating — e `Like` che dichiara
`$table = 'likes'` senza che nessuna migrazione crei quella tabella.

Scopo esteso, misure e mosse: [docs/scopo.md](docs/scopo.md).

---

## Perché

Uno schema rigido per ogni tipo di valutazione moltiplica le migration e
irrigidisce il dominio. Rating usa attributi schemaless per rappresentare
qualunque criterio di valutazione senza toccare il database ogni volta che
cambia cosa si vuole misurare.

## Logica

Il modello di rating non conosce a priori i suoi campi — li riceve. Chi lo
consuma definisce cosa significa "valutare" nel proprio contesto; il modulo
garantisce solo che la valutazione sia tracciabile, storicizzata, coerente.

## Filosofia

**Flessibile non vuol dire senza regole.** Schemaless non è sinonimo di
non tipizzato: PHPStan gira a `level: max` su questo modulo esattamente come
su tutti gli altri, anche se i dati che manipola non hanno una colonna fissa.

## Religione

**Ogni numero qui ha un comando dietro, incluso quello scomodo.** Il PHPMD di
questo modulo è misurato su un'analisi parziale (abortita in corso — vedi
`docs/quality-audit.md`): 38 rilievi noti, non il quadro completo. Dichiarato
così, non arrotondato a "pulito".

## Politica

`laravel/phpstan.neon` è sacro — nessun agente lo tocca. Verifica sempre
nuda, mai con `-c`/`--level` custom.

## Zen

Una stella su cinque non dice niente da sola. Il criterio dietro sì — ed è
quello che questo modulo custodisce.

---

## Stato misurato — 1 settembre 2026

| Metrica | Valore | Comando |
|---|---:|---|
| File PHP / righe di codice | 137 / 6.678 | `find app -name '*.php' \| xargs wc -l` |
| File di test / casi | 20 / 125 (0.91/file) | `./vendor/bin/pest Modules/Rating` |
| PHPStan | **0 errori**, `level: max` | `./vendor/bin/phpstan analyse Modules/Rating` |
| `@phpstan-ignore` | 2 | `docs/quality-audit.md` |
| PHPInsights — Code | 97.6 % | `./tools/phpinsights.sh Modules/Rating` |
| PHPInsights — Complexity | 100.0 % | idem |
| PHPInsights — Architecture | 78.6 % | idem |
| PHPInsights — Style | 93.8 % | idem |
| PHPMD su `app/` | 38 rilievi — **analisi parziale, non il quadro completo** | `./tools/phpmd.sh Modules/Rating/app` |

Dettaglio completo in [`docs/quality-audit.md`](docs/quality-audit.md).

## Come si verifica (non fidarti di questo file)

```bash
cd laravel
./vendor/bin/phpstan analyse Modules/Rating          # 0 errori atteso
./tools/phpmd.sh Modules/Rating/app                  # NON la root del modulo
./tools/phpinsights.sh Modules/Rating
./vendor/bin/pest Modules/Rating
```

## Documentazione

| | |
|---|---|
| Audit di qualità (fonte dei numeri sopra) | [`docs/quality-audit.md`](docs/quality-audit.md) |
| Wiki tecnica | [`docs/`](docs/) |

---

<<<<<<< HEAD
## Scopo del modulo

Perche' esiste, come raggiungere meglio il suo scopo e cosa **non** gli appartiene:
[`docs/purpose.md`](./docs/purpose.md).

---

**Modulo** `rating` · licenza MIT
=======
**Modulo** `rating` · **Laraxot** · **Rating Module** · PHPStan 10 · Filament 5
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
