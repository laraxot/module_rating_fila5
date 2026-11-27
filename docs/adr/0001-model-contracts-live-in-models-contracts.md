---
title: "ADR — I contratti implementabili solo da un model stanno in app/Models/Contracts"
type: decision
status: accepted
created: 2026-09-09
updated: 2026-11-26
module: Rating
decision-makers: [team Laraxot]
tags: [adr, contracts, namespace, phpstan, models]
related:
  - ../wiki/concepts/dove-vive-un-contratto.md
qmd: "model contracts live models contratti implementabili"
---

# ADR: dove vive un'interfaccia

## Contesto

Rating ha due cartelle di interfacce: `app/Models/Contracts/` (`RatingContract`, `HasRatingContract`) e
`app/Contracts/` (`RatingsFormCallerContract`, `HasLikeContract`). `RatingContract` esiste perché `Rating` è
consumato da più moduli, ciascuno con la propria classe concreta su una connessione diversa (docblock di
`app/Models/Contracts/RatingContract.php`), e porta `@phpstan-require-extends Model`. `RatingsFormCallerContract`
lo implementa una Page di Filament. Un agente che aggiunge un'interfaccia sceglie la cartella del file più vicino,
e un nome di namespace che mente ("Models" su qualcosa che non è un model) viene copiato. Dove si mette un'interfaccia nuova?

## Driver della decisione

- Il nome del namespace deve dire chi puo' implementare l'interfaccia, prima di aprire il file: «Models» solo per cio' che solo un model puo' implementare.
- Un agente che aggiunge un'interfaccia sceglie la cartella del file piu' vicino: serve una regola che non dipenda dalla vicinanza.
- Spostare un'interfaccia cambia il FQCN in tutti i moduli consumatori: la regola va fissata prima che le interfacce diventino piu' numerose.

## Decisione

- Un'interfaccia che porta `@phpstan-require-extends Model` (implementabile solo da un model) sta in
  `app/Models/Contracts/` (`Modules\Rating\Models\Contracts\…`).
- Tutte le altre stanno in `app/Contracts/`.
- La regola estesa con gli esempi è in `../wiki/concepts/dove-vive-un-contratto.md`.

## Alternative scartate

- **Tutto in `app/Contracts/`**: un'unica cartella, ma perde l'informazione "solo un model può implementarla" che il
  namespace oggi dà prima di aprire il file.
- **Tutto in `app/Models/Contracts/`**: `RatingsFormCallerContract` direbbe di cercare un model che non esiste.

## Conseguenze

- Buono: il namespace dice chi può implementare l'interfaccia.
- Cattivo: due cartelle da conoscere; spostare un'interfaccia cambia il FQCN in tutti i moduli consumatori.

## Stato attuale

Letto dal codice il 2026-11-26:

- `rg -n "phpstan-require-extends" app/Models/Contracts app/Contracts` trova solo `RatingContract.php` (riga 41): `HasRatingContract`, che sta in `app/Models/Contracts/`, **non** porta l'annotazione, contro la regola della Decisione. E' voluto dai test: `tests/Unit/HasRatingActionsTest.php` costruisce `Mockery::mock(HasRatingContract::class)`, che non e' un model e verrebbe segnalato da PHPStan.
  La cartella dice «contratto di un model» ma non lo impone; la regola «porta `@phpstan-require-extends Model` => sta in `app/Models/Contracts/`» vale in una direzione sola.
- `app/Contracts/` contiene `RatingsFormCallerContract` e `HasLikeContract`, senza l'annotazione, come da Decisione.

## Conferma

- PHPStan (`cd laravel && ./vendor/bin/phpstan analyse Modules/Rating`) fallisce se una classe che non estende `Model` implementa `RatingContract`: protegge il vincolo, non la cartella.
- Comando: `rg -n "phpstan-require-extends" app/Models/Contracts app/Contracts` dal modulo: ogni file con l'annotazione deve stare in `app/Models/Contracts/` (oggi: solo `RatingContract.php`).
- Nessuna conferma automatica per la cartella di un'interfaccia nuova: solo revisione. Proposta: un test Pest arch in `Modules/Rating/tests/Arch/` che falli se un'interfaccia con l'annotazione sta fuori da `app/Models/Contracts/`.
