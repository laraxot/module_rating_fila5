---
title: "Decision log — Rating"
type: decision-log
status: active
updated: 2026-11-16
module: Rating
qmd: "decision log Rating audit rating_morph migration additiva trait morti pest skip"
---

# Decision log — Rating

Formato: **data · decisione · stato · motivo · conseguenza**. Evidenza completa in [audits/rating-audit.md](./audits/rating-audit.md).

| Data | Decisione | Stato | Motivo | Conseguenza |
|---|---|---|---|---|
| 2026-11-16 | Integrità `rating_morph` = P1 (RAT-P1-01) | approvata | morph senza FK/unique/morphMap; rischio già scritto in [purpose.md](./purpose.md) e mai mitigato | Epic A in [epics.md](./epics.md) |
| 2026-11-16 | Correggere lo schema con una migration nuova, non editando le 6 esistenti | approvata | dati sacri: solo migrate additivo; le vecchie sono già eseguite altrove | vedi RAT-P1-02 |
| 2026-11-16 | `_archive_redundant/` e `_bak/` restano dove sono | approvata | `loadMigrationsFrom` non è ricorsivo ([XotBaseServiceProvider.php:42](../../../Xot/app/Providers/XotBaseServiceProvider.php)): non vengono eseguite | nessun rischio di doppio run; spostarle fuori è pulizia (P2) |
| 2026-11-16 | Trait `RatingTrait`/`HasRating` candidati alla rimozione | proposta | zero consumer, dichiarato dagli stessi `@phpstan-ignore trait.unused` | rimozione dopo `rg` sui moduli consumer e Pest verde |
| 2026-11-16 | Pest = skip documentato | approvata | timeout 420 s, `10.100.200.53:3306` irraggiungibile | PHPStan è il gate attivo |
| 2026-11-16 | `purpose.md` riallineato al codice | approvata | citava 34 Action/15 Widget e `RatingMorphTrait` inesistente | la documentazione segue `rg` |
