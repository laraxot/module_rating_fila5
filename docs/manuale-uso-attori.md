---
title: "Manuale d'uso per attori - Rating"
module: Rating
type: manuale-uso
---

# Modulo Rating

## Scopo

Rating permette a un utente autenticato di valutare un modello che implementa
`HasRatingContract`/`HasRatingsTrait`. Mantiene la relazione polimorfica, una
valutazione per coppia utente/entità, aggregazioni e gestione amministrativa
tramite Filament.

## Matrice attori

| Attore | Accesso o responsabilità verificata |
|---|---|
| Ospite | N/A: la valutazione richiede un utente autenticato. |
| Utente autenticato | Può creare valutazioni tramite il contratto/trait integrato nel modello consumer; per i record morph può anche vedere/modificare il proprio record quando la policy lo riconosce come proprietario. |
| Gruppo/ruolo | `evaluator` può vedere e creare; sui record morph può aggiornare o cancellare il proprio record. `hr-manager` può creare/aggiornare. |
| Admin | Può vedere, creare, aggiornare e cancellare secondo `RatingPolicy`/`RatingMorphPolicy`. |
| Super-admin | Può eseguire tutte le abilità, inclusi restore e force delete. |
| Operatore | N/A. |

## Flussi reali

1. Un modulo consumer aggiunge il trait Rating al proprio modello.
2. L'utente autenticato invia il voto tramite le Actions del modulo consumer o
   l'integrazione UI disponibile.
3. La regola di unicità aggiorna il voto esistente invece di crearne un doppio.
4. Le medie e i conteggi sono usati dalla UI e dall'amministrazione.
5. Admin, `hr-manager`, `evaluator` e super-admin operano sulle Resource
   Filament secondo le policy; restore e force delete restano del super-admin.

## Prerequisiti

- Modulo User e utente autenticato per la creazione.
- Modello consumer compatibile con il contratto/trait Rating.
- Tabelle e migrazioni Rating disponibili.
- Ruoli applicativi coerenti con le policy per il back office.

## Limiti

- Il modulo non espone route web/API proprie operative: i file route sono
  vuoti; l'integrazione passa da consumer, Actions e Filament.
- Rating non importa i moduli consumer: il verso della dipendenza è consumer →
  Rating.
- `admin` e `hr-manager` non hanno tutti i poteri del super-admin; restore e
  force delete sono esplicitamente riservati a quest'ultimo.

## Link a codice/docs

- [README](README.md)
- [Architettura](architecture.md)
- [Policy rating](../app/Models/Policies/RatingPolicy.php)
- [Policy rating morph](../app/Models/Policies/RatingMorphPolicy.php)
- [Trait consumer](../app/Models/Traits/HasRatingsTrait.php)
- [Resource rating](../app/Filament/Resources/RatingResource.php)
- [Impostazioni](../app/Filament/Pages/SettingPage.php)
