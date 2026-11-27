---
title: "Contratto — GetRatingOptsByModelAction"
type: contract
<<<<<<< .merge_file_LPx3Z6
action: "Modules\Rating\Actions\HasRating\GetRatingOptsByModelAction"
tags: [contract, action, rating, options]
created: 2026-11-24
updated: 2026-11-24
=======
action: "Modules\\Rating\\Actions\\HasRating\\GetRatingOptsByModelAction"
module: Rating
status: active
tags: [contract, action, rating, options]
created: 2026-11-24
updated: 2026-11-26
>>>>>>> .merge_file_WcWwBA
---

# GetRatingOptsByModelAction

<<<<<<< .merge_file_LPx3Z6
Sorgente: `app/Actions/HasRating/GetRatingOptsByModelAction.php`. Nel checkout attuale non ha chiamanti in produzione (`StatsOverview` ripete il filtro a mano). Semantica di `rating_morph`:
[ADR opzioni e voti nella stessa pivot](../adr/rating-morph-options-and-votes-same-pivot.md).

## Input

- `HasRatingContract $model`: il model di cui si vogliono le opzioni di voto.

## Output

- `array<int, string|null>`: id del criterio → `title` (`null` se il titolo non è una stringa).
=======
Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`). Perche': ADR [0002](../adr/0002-rating-morph-options-and-votes-same-pivot.md).
Sorgente: `app/Actions/HasRating/GetRatingOptsByModelAction.php`. Chiamante di produzione: nessuno nel modulo (`rg GetRatingOptsByModelAction app --glob '*.php'` trova solo la classe); `StatsOverview` e `HasRating::getOptionRatingsIdTitle()` rifanno lo stesso filtro a mano.

## Input

- `HasRatingContract $model`.

## Output

- `array<int, string|null>`: `ratings.id` => `ratings.title` per le opzioni del model, cioe' le pivot senza utente.
>>>>>>> .merge_file_WcWwBA

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
<<<<<<< .merge_file_LPx3Z6
| RATING-OPTS-INV-1 | Solo le righe-opzione: pivot con `user_id` nullo; i voti non producono opzioni. | `RATING-OPTS-INV-1` |
| RATING-OPTS-INV-2 | Le chiavi sono gli id interi di `ratings.id`, i valori il `title` del criterio. | `RATING-OPTS-INV-2` |

## Effetti collaterali

- Una query di lettura (`pluck`). Nessuna scrittura.

## Errori

- Nessuna eccezione propria; errori del database risalgono.

## Non fa

- Non traduce il titolo né usa `txt` (il nome leggibile): ritorna `title`, il nome tecnico.
- Non ordina e non filtra per `is_readonly` o regola.
- Non attiva né disattiva opzioni: le righe-opzione si creano altrove (attach sulla relazione `ratings()`).
=======
| RATING-OPTS-INV-1 | Seleziona solo le opzioni, cioe' le pivot con `user_id` nullo (`wherePivot('user_id', null)`), mai i voti. Se cade, i voti degli utenti compaiono tra le opzioni. | `RATING-OPTS-INV-1` |
| RATING-OPTS-INV-2 | Solo lettura: non assegna voti e non aggiorna il model. | `RATING-OPTS-INV-2` |
| RATING-OPTS-INV-3 | Le chiavi sono interi (cast `(int)` sull'id) e un titolo che non e' una stringa diventa `null`. | — (non dimostrato) |

## Effetti collaterali

- Una `SELECT` (`pluck('title', 'ratings.id')`) sulla relazione `ratings()`. Nessuna scrittura.

## Errori

- Gli errori Eloquent/DB della relazione risalgono al chiamante.

## Non fa

- Non calcola somme ne' conteggi (`GetSumByModelRatingIdAction`, `GetCountByModelRatingIdAction`).

## Limiti noti

- Le versioni di questo contratto del 2026-11-26 avevano rinominato gli ID con il prefisso `RATING-OPTIONS-` al posto di `RATING-OPTS-`; il test e il contratto committato usano `RATING-OPTS-`, ripristinato qui: un ID non si rinomina.
- Il test usa un mock della relazione: prova il filtro e che non si chiamano altri metodi, non il risultato su database; INV-3 non e' coperta perche' il mock restituisce gia' chiavi intere e titoli stringa.
>>>>>>> .merge_file_WcWwBA
