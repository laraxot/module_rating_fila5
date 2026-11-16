---
qmd: audit approfondito modulo Rating BMAD architettura dominio sicurezza test qualità
title: Audit approfondito modulo Rating
status: baseline-review
---

# Audit approfondito modulo Rating

## Scopo e metodo

Questo artefatto BMAD è la baseline source-first del modulo `Rating`. L'audit
parte da codice, configurazione, migration, test e documentazione versionata;
non tratta nomi di classi o documenti come prova di comportamento runtime. Ogni
fix successivo deve conservare lo scopo funzionale, avere una story e superare
PHPStan/Pest proporzionati.

## Inventario misurato

| Superficie | Conteggio |
|---|---:|
| PHP in `app/` | 76 |
| Test PHP | 42 |
| Resource Filament rilevate | 4 |
| Policy in `app/Models/Policies` | 4 |
| Action | 3 |
| Migration | 12 |
| Viste `admin_test` | 0 |
| Markdown in `docs/` | 596 |
| Markdown senza frontmatter | 21 |
| Marker di conflitto | 0 |
| Label/tooltip letterali Filament | 1 |


## Analisi Funzionale e Scopo di Dominio

### Perché Esiste (Scopo Fondamentale)
Framework generico polimorfico di rating, scoring e valutazione multidimensionale.

### Valore di Business e Utilità
Fornisce un motore di valutazione riutilizzabile applicabile a qualsiasi modello (dipendenti, prestazioni, servizi, fornitori).

### Architettura e Pattern Laraxot
HasRatingsTrait; tabella morph polimorfica  come Source of Truth; calcoli di medie ponderate e ranking.

### Standard di Qualità e Conformità
- **PHPStan**: Confermato a Level Max con 0 errori.
- **Filament**: Conformità Filament 5 con estensione delle classi XotBase*.
- **Naming**: Convenzione kebab-case rigorosa per tutti i documenti e classi PSR-4.
- **Trans**: Traduzioni dinamiche via Lang, nessun testo hardcoded.

## Audit per dimensione

### Architettura e confini

- verificare `module.json`, `composer.json`, provider, autoload e dipendenze;
- distinguere API pubbliche, consumer cross-module e codice interno;
- controllare che la direzione delle dipendenze non introduca cicli;
- registrare il modello canonico quando esistono adapter o doppioni.

### Dominio e dati

- ricostruire invarianti, chiavi naturali, stati e transizioni;
- verificare connessione tenant, migration additive, indici e foreign key;
- cercare update massivi, SQL raw, side effect in accessor/render/table;
- rendere idempotenti import, sync, ricalcoli e job asincroni.

### Sicurezza e privacy

- verificare panel access, policy, Gate, scope tenant e URL diretti;
- testare ruoli guest/operator/admin/super-admin quando presenti;
- proteggere export, PDF, ZIP, mail, import e azioni massive;
- minimizzare dati personali in log, notifiche, file temporanei e output.

### Filament/API/UI

- verificare uso delle classi base Xot e API della versione Filament installata;
- controllare validazione, mass assignment, conferme, errori e stati loading;
- rimuovere stringhe UI hardcoded e verificare traduzioni;
- profilare N+1 prima di introdurre eager loading.

### Test e qualità

- separare test unitari, feature, browser e test dipendenti da DB condiviso;
- classificare ogni skip con causa e comando riproducibile;
- eseguire PHPStan level max sul modulo con cache isolata;
- eseguire Pest mirato e documentare eventuali blocchi ambientali.

### Documentazione e operatività

- mantenere SSoT in `docs/bmad` e puntatori nell'indice del modulo;
- usare nomi Markdown stabili in kebab-case senza date/timestamp;
- includere frontmatter YAML e chiave `qmd`;
- documentare bootstrap locale, rollback non distruttivo, osservabilità e runbook.

## Rischi statici classificati

- P2: 1 label/tooltip Filament letterali; verificare traduzioni Lang e accessibilità.
- P2: 21 documenti senza frontmatter; normalizzare senza perdere riferimenti.

## Piano BMAD di miglioramento

1. **Recon:** confermare inventario con `rg`, graph/QMD e caller reali.
2. **Architecture:** scrivere decisione sul confine e sul modello canonico.
3. **Security:** chiudere policy, tenant scope e azioni ad alto impatto.
4. **Build:** correggere PHPStan alla sorgente, senza baseline o ignore cosmetici.
5. **Test:** aggiungere un test piccolo per ogni invarianta o branch corretto.
6. **Docs:** aggiornare manuale, indice, story e memoria QMD.
7. **Review:** eseguire PHPStan, Pest, `git diff --check` e controllo marker.

## Acceptance criteria

- [ ] ogni rischio P0/P1 ha una story figlia con owner, AC e riferimenti;
- [ ] PHPStan del modulo è verde su una cache isolata;
- [ ] Pest mirato è verde oppure lo skip è documentato e riproducibile;
- [ ] nessun dato viene distrutto e nessuna migration è distruttiva;
- [ ] il comportamento runtime è verificato, non solo dedotto dal codice;
- [ ] docs e indice sono aggiornati con QMD.

## Evidenze e limiti

Metriche generate dal tree corrente; i conteggi non sostituiscono l'analisi dei
caller né il test runtime. Le conclusioni positive richiedono una verifica
successiva con output dei gate registrato nella story del modulo.
