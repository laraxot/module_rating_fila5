---
title: "Glossario di dominio Rating"
type: glossary
owner: Rating
updated: 2026-11-24
qmd: "glossario Rating criterio voto pivot rating_morph host valutabile like policy RuleEnum"
---

# Glossario di dominio Rating

Se glossario e codice divergono vale il codice. Percorsi relativi a `laravel/Modules/Rating/`.

| Termine | Significato | Nel codice |
|---|---|---|
| Rating (criterio) | Voce del catalogo condiviso su cui si vota; può avere attributi extra schemaless. | `app/Models/Rating.php`, `app/Models/BaseRating.php` (`extra_attributes`) |
| Voto (rating morph) | Il voto effettivo di un criterio su un modello, sul pivot `rating_morph`, con campo `value`. | `app/Models/RatingMorph.php`, `app/Models/BaseRatingMorph.php:97`, `app/Datas/RatingMorphData.php` |
| Host valutabile | Modello che può ricevere voti; espone la relazione `ratings()` (`MorphToMany`). | `app/Models/Contracts/HasRatingContract.php`, `app/Models/Traits/HasRatingsTrait.php` |
| Host astratto | Ancora per l'analisi statica degli host cross-modulo; non mappa tabelle. | `app/Models/AbstractRatingsHost.php` |
| Doppio `model_type` | Il pivot contiene per la stessa entità sia l'alias della morph map sia il nome classe: `ratings()` vede solo `getMorphClass()`. | `app/Models/Traits/HasRatingsTrait.php:50-55` |
| Somma / conteggio voti | Aggregazioni sui voti con `user_id` valorizzato, opzionalmente per criterio. | `app/Actions/HasRating/GetSumByModelRatingIdAction.php`, `GetCountByModelRatingIdAction.php` |
| Regola di voto | Stringa di regole di validazione Laravel (`numeric\|min:0\|max:4`, ...) associata a un criterio; il valore dell'enum è anche chiave di traduzione. | `app/Enums/RuleEnum.php` |
| Blocco rating | DTO di un blocco di interfaccia (titolo, descrizione, posizione, locale, immagine). | `app/Datas/RatingBlockData.php` |
| Rating (DTO) | DTO che porta due concetti con lo stesso nome: blocco di UI ed entità `ratings`. | `app/Datas/RatingData.php:19-23` |
| Configurazione rating | DTO di configurazione del modulo. | `app/Datas/RatingConfigData.php` |
| Like | Voto binario polimorfico (preferiti), via trait `HasLikes`. | `app/Models/Like.php`, `app/Models/Traits/HasLikes.php` |
| Valutatore (`evaluator`) | Ruolo che può creare valutazioni e modificare/cancellare solo le proprie. | `app/Models/Policies/RatingMorphPolicy.php:16-56` |
| Responsabile HR (`hr-manager`) | Ruolo che vede, crea e modifica tutte le valutazioni ma non le cancella. | `RatingMorphPolicy.php:16-56` |
| Proprietario del valutato | Utente il cui `user_id` o la cui matricola (`matr`) coincide con quella del modello valutato. | `RatingMorphPolicy.php:77-101` |
| Locale supportato | Enum dei locali per i blocchi rating. | `app/Enums/SupportedLocale.php` |
