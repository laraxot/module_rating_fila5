---
title: "Memories Index"
type: index
created: 2026-05-11
updated: 2026-05-11
tags: [memories, index, on-demand]
related:
  - ../rules/00-TRIGGER_MAP.md
  - ../rules/on-demand-pattern.md
---

# Memories Index

Le Memories progettuali vivono qui, nel wiki del Module **Rating**, e vengono caricate **on-demand**.

<<<<<<< HEAD
> Vedi anche → Trigger Map
=======
> Vedi anche → [Trigger Map](../rules/00-TRIGGER_MAP.md)
>>>>>>> e8cf105 (Check & fix styling)

## Regola

1. individua il trigger del task
2. consulta `../rules/00-TRIGGER_MAP.md`
3. se serve, esegui `qmd search "<topic>"`
4. leggi solo la Memories wiki pertinente

## Pattern di caricamento

| Pattern | Comando |
|---------|---------|
| Carica Memories specifica | `Read ../memories/<name>.md` |
| Ricerca semantica | `qmd search "<topic>"` |
| Via trigger map | Consulta `../rules/00-TRIGGER_MAP.md` |

## Note

- La sorgente di verita' per le Memories e' sempre il wiki locale
- Non embeddare Memories nei prompt di avvio
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
- Per Memories globali, consulta il [wiki root](../../docs/wiki/memories/INDEX.md)
=======
>>>>>>> laraxot/dev
<<<<<<< HEAD
<<<<<<< HEAD
- Per Memories globali, consulta il [wiki root](../../docs/wiki/memories/INDEX.md)
=======
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
- Per Memories globali, consulta il [wiki root](../../docs/wiki/memories/index.md)
=======
- Per Memories globali, consulta il [wiki root](../../docs/wiki/memories/INDEX.md)
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
- Per Memories globali, consulta il [wiki root](../../docs/wiki/memories/INDEX.md)
>>>>>>> e8cf105 (Check & fix styling)

## Aggiungere una Nuova MEMORIES

1. Crea `../memories/<nome>.md` con contenuto completo
2. Aggiungi la voce in `../rules/00-TRIGGER_MAP.md`
3. Aggiorna questo indice se la Memories e' ricorrente
4. Committa: `docs: add memories <nome>`

