---
title: "Contratto — HasRatingsTrait (scrittura dei voti sulla pivot)"
type: contract
action: "Modules\\Rating\\Models\\Traits\\HasRatingsTrait"
module: Rating
status: active
tags: [contract, trait, rating, write, pivot]
created: 2026-11-26
updated: 2026-11-26
---

# HasRatingsTrait: percorso di scrittura

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`). Perche': ADR [0002](../adr/0002-rating-morph-options-and-votes-same-pivot.md).
Sorgente: `app/Models/Traits/HasRatingsTrait.php`. Il modulo non ha Action che scrivono voti: il percorso e' `syncRatingsFormData()` (riga 513), `clearEvaluation()` (riga 555) e l'alias `clearRatingsFormData()` (riga 587), chiamati dai form Filament degli host.
Sono le sole scritture del modulo su `rating_morph`: il resto del trait legge.

## Input

- Un host Eloquent gia' salvato (`getKey()` non nullo).
- `syncRatingsFormData(array $ratingsData)`: mappa `rating_id => ['pivot' => ['value' => ..., 'note' => ...]]`.
- `clearEvaluation()`: nessun dato.

## Output

- `void`: lo stato e' sulla pivot `rating_morph` dell'host.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| RATING-WRITE-INV-1 | `syncRatingsFormData` aggiorna solo le righe di questo host e di quel `rating_id`, passando da `ratingMorphs()`; mai un `update` globale su `rating_id`. Se cade, la valutazione di un record sovrascrive quella di tutti gli altri. | `RATING-WRITE-INV-1` |
| RATING-WRITE-INV-2 | `value` mancante, `null`, non numerico o la chiave «altro» (`other`) diventa `null` sul pivot, mai `0`: uno zero e' un voto reale. | `RATING-WRITE-INV-2` |
| RATING-WRITE-INV-3 | Se per host e rating non c'e' nessuna riga (`update` ne ha toccate 0), crea una sola pivot con `attach()`. | `RATING-WRITE-INV-3` |
| RATING-WRITE-INV-4 | Un host non salvato lancia `LogicException` prima di scrivere (sia `syncRatingsFormData` sia `clearEvaluation`). | — (non dimostrato) |
| RATING-WRITE-INV-5 | Dopo la scrittura le relazioni `ratings` e `ratingMorphs` gia' caricate vengono scaricate: la rilettura mostra i valori nuovi. | `RATING-WRITE-INV-5` |
| RATING-WRITE-INV-6 | `note` presente nel payload passa invariata se e' stringa o `null`, altrimenti diventa `null`; se manca nel payload non viene toccata. | `RATING-WRITE-INV-6` |
| RATING-WRITE-INV-7 | `clearEvaluation()` mette `value` e `note` a `null` su tutte le pivot dell'host (alias e FQCN) senza crearne ne' cancellarne e senza toccare il catalogo `ratings`; `clearRatingsFormData()` fa lo stesso e ignora la collection passata. | `RATING-WRITE-INV-7` |
| RATING-WRITE-INV-8 | `ratingMorphTypes()` restituisce l'alias della morph map e il FQCN del padre per un figlio STI, mai la classe figlia, senza duplicati. | `RATING-WRITE-INV-8` |

## Effetti collaterali

In quest'ordine:

1. `UPDATE rating_morph` sulle righe dell'host (`ratingMorphs()->where('rating_id', ...)->update($payload)`), una per `rating_id` del payload; `clearEvaluation` fa un solo `UPDATE` senza filtro per rating.
2. Se l'`UPDATE` non ha toccato righe: `INSERT` della pivot con `ratings()->attach($id, $payload)` (riga 540).
3. `unsetRelation('ratings')` e `unsetRelation('ratingMorphs')`.

Nessuna transazione, nessun evento.

## Errori

- `LogicException` se l'host non e' salvato (righe 516 e 558).
- Gli errori DB risalgono al chiamante; con piu' `rating_id` nel payload una riga fallita lascia le precedenti gia' scritte.

## Non fa

- Non autorizza: lo fa `RatingMorphPolicy` e la pagina che chiama.
- Non aggrega: somme e conteggi sono di [GetSumByModelRatingIdAction](get-sum-by-model-rating-id-action.md) e [GetCountByModelRatingIdAction](get-count-by-model-rating-id-action.md).
- Non normalizza lo storico a doppio `model_type` (alias e FQCN): lo legge con `ratingMorphs()` (story `rating-morph-model-type-doppio`).
- **Non imposta `user_id`.** Il payload contiene solo `value` e `note` (righe 527-535).

## Limiti noti

- **Un voto creato dal trait nasce senza `user_id`.** `attach($id, $payload)` non scrive `user_id` e nessun hook di `BaseRatingMorph`/`BaseMorphPivot` lo imposta (`rg 'creating|saving|boot' app/Models/BaseRatingMorph.php app/Models/BaseMorphPivot.php` e' vuoto). Per l'ADR 0002 una riga con `user_id` nullo e' un'**opzione**: la riga creata sarebbe esclusa da somma e conteggio e inclusa da `GetRatingOptsByModelAction`.
  E' una contraddizione letta dal codice, non misurata su dati: va decisa da chi possiede il modello (host con una sola scheda per record, senza utente per voto?).
- **Nessuna transazione**: con piu' rating nel payload, un errore a meta' lascia scritto solo l'inizio.
- Le prove di INV-1..3, 5..8 usano mock (`forcedHasMany`, `forcedMorph` negli stub di `tests/Fixtures/RatingsHostStub.php`) e non un database: provano quali chiamate fa il trait, non il risultato nelle righe.
- INV-4 non ha test: `rg LogicException Modules/Rating/tests` e' vuoto.
