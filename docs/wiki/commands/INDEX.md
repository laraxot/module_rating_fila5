---
title: "Commands Index"
type: index
created: 2026-05-11
updated: 2026-05-11
tags: [commands, index, on-demand]
related:
  - ../rules/00-TRIGGER_MAP.md
  - ../rules/on-demand-pattern.md
---

# Commands Index

Le Commands progettuali vivono qui, nel wiki del Module **Rating**, e vengono caricate **on-demand**.

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
> Vedi anche → Trigger Map
=======
> Vedi anche → [Trigger Map](../rules/00-TRIGGER_MAP.md)
>>>>>>> e8cf105 (Check & fix styling)
=======
> Vedi anche → [Trigger Map](../rules/00-TRIGGER_MAP.md)
>>>>>>> 77b9106 (.)
=======
> Vedi anche → [Trigger Map](../rules/00-TRIGGER_MAP.md)
>>>>>>> c91c8c3 (.)
=======
> Vedi anche → [Trigger Map](../rules/00-TRIGGER_MAP.md)
>>>>>>> 2025498 (.)

## Regola

1. individua il trigger del task
2. consulta `../rules/00-TRIGGER_MAP.md`
3. se serve, esegui `qmd search "<topic>"`
4. leggi solo la Commands wiki pertinente

## Pattern di caricamento

| Pattern | Comando |
|---------|---------|
| Carica Commands specifica | `Read ../commands/<name>.md` |
| Ricerca semantica | `qmd search "<topic>"` |
| Via trigger map | Consulta `../rules/00-TRIGGER_MAP.md` |

## Note

- La sorgente di verita' per le Commands e' sempre il wiki locale
- Non embeddare Commands nei prompt di avvio
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/INDEX.md)
=======
>>>>>>> laraxot/dev
<<<<<<< HEAD
<<<<<<< HEAD
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/INDEX.md)
=======
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/index.md)
=======
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/INDEX.md)
>>>>>>> laraxot/dev
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
>>>>>>> laraxot/dev
=======
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/INDEX.md)
>>>>>>> e8cf105 (Check & fix styling)
=======
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/INDEX.md)
>>>>>>> 77b9106 (.)
=======
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/INDEX.md)
>>>>>>> c91c8c3 (.)
=======
- Per Commands globali, consulta il [wiki root](../../docs/wiki/commands/INDEX.md)
>>>>>>> 2025498 (.)

## Aggiungere una Nuova COMMANDS

1. Crea `../commands/<nome>.md` con contenuto completo
2. Aggiungi la voce in `../rules/00-TRIGGER_MAP.md`
3. Aggiorna questo indice se la Commands e' ricorrente
4. Committa: `docs: add commands <nome>`

