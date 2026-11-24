---
status: proposed
date: 2026-11-23
decision-makers: Rating module owner
---

# Rating è una capacità polimorfica riusabile, separata dal dominio consumer

## Contesto

Rating deve applicarsi a modelli appartenenti a moduli diversi. `HasRatingsTrait`
definisce relazione polimorfica, letture e aggregazioni; il modello host importa il
trait, mentre Rating non importa i consumer. Le policy di `Rating` e `RatingMorph`
delimitano la gestione del catalogo e delle singole valutazioni. La decisione
risponde a questa domanda: come si riusa il rating senza trasformarlo in workflow o
autorizzazione del dominio?

## Driver della decisione

- riuso su modelli host diversi tramite relazione polimorfica;
- dipendenza unidirezionale dal consumer verso Rating;
- separazione tra valutazione, workflow e autorizzazione;
- lettura controllata dei dati storici con forme diverse di `model_type`.

## Alternative scartate

- Creare rating in ogni modulo consumer: duplicherrebbe relazione, validazione e
  aggregazioni.
- Far importare a Rating modelli o policy dei consumer: introdurrebbe dipendenze
  circolari.
- Usare il rating per approvare, chiudere o autorizzare una pratica: confonderebbe
  feedback e stato operativo.

## Decisione

Rating è **un componente polimorfico di feedback**. I consumer usano
`HasRatingsTrait` e le relazioni del modulo; policy e gestione delle entità Rating
restano in Rating. Il trait mantiene temporaneamente la lettura sia dell'alias morph
sia del FQCN per i record storici: è compatibilità, non una nuova persistenza.

## Conseguenze

- Buono, perché un consumer aggiunge la capacità senza importare altri domini.
- Buono, perché feedback e autorizzazione restano concetti separati.
- Cattivo, perché la compatibilità con due forme di `model_type` conserva debito
  storico e richiede test sulle aggregazioni.
- Cattivo, perché la policy effettiva dipende anche dal modello valutato, non dalla UI.

## Conferma

- Integrazione: [`HasRatingsTrait`](../../app/Models/Traits/HasRatingsTrait.php).
- Catalogo: [`RatingPolicy`](../../app/Models/Policies/RatingPolicy.php).
- Righe polimorfiche: [`RatingMorphPolicy`](../../app/Models/Policies/RatingMorphPolicy.php).
- Riferimento: [`docs/architecture.md`](../architecture.md).
