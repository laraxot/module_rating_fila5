<?php

declare(strict_types=1);

use Filament\Forms\Components\Hidden;
use Modules\IndennitaResponsabilita\Filament\Resources\RatingResource\RelationManagers\ChildrenRelationManager;
use Modules\IndennitaResponsabilita\Models\Rating;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

/**
 * Creando un figlio dal RelationManager, il padre lo imposta la relazione.
 *
 * `children()` è una `HasMany` con chiave esterna `parent_id`: un `CreateAction` di
 * RelationManager crea **attraverso la relazione**, quindi `parent_id` arriva dal
 * record aperto senza che nessuno lo scriva nel form.
 *
 * Il test esiste perché quel comportamento oggi è **corretto ma invisibile**: nulla
 * nel form dice «il padre lo mette la relazione», e basta che qualcuno tolga
 * `getFormSchema()` dal RelationManager perché venga ereditato quello della Resource,
 * che `parent_id` ce l'ha — e da lì un utente potrebbe appendere il figlio a un
 * padre diverso, dalla pagina sbagliata.
 *
 * **Perché nascosto e non assente**: il valore lo scrive la relazione in ogni caso,
 * ma un campo che non c'è non dice niente a chi legge il form, e un `Select` visibile
 * direbbe una cosa falsa — che il padre si sceglie. `Hidden` già valorizzato è l'unica
 * forma che porta il valore vero senza fingere una decisione.
 *
 * Nessun rischio di divergenza in creazione: `CreateAction` fa `$record->fill($data)`
 * e **poi** `$relationship->save($record)` (`vendor/filament/actions/src/CreateAction.php`,
 * righe 84 e 103), quindi la relazione scrive per ultima e vince comunque.
 *
 * Nessun dato scritto: creazione dentro una transazione con rollback. Niente
 * `RefreshDatabase`.
 *
 * @see laravel/Modules/Rating/docs/stories/rating-gerarchia-parent-id-e-figli-in-edit.story.md
 */
test('la relazione children imposta parent_id sul figlio creato', function (): void {
    $parent = Rating::query()->firstOrFail();
    $connection = $parent->getConnection();

    Assert::assertSame(
        'parent_id',
        $parent->children()->getForeignKeyName(),
        'La chiave esterna di children() deve essere parent_id: e\' quella che rende '
        .'automatico il padre nella creazione da RelationManager.'
    );

    $connection->beginTransaction();

    try {
        $child = $parent->children()->create(['title' => 'test-rollback']);

        Assert::assertSame(
            $parent->getKey(),
            $child->getAttribute('parent_id'),
            'Creando attraverso la relazione, parent_id deve essere quello del record aperto.'
        );
    } finally {
        $connection->rollBack();
    }
});

test('nella creazione di un figlio il padre non e una scelta', function (): void {
    $schema = app(ChildrenRelationManager::class)->getFormSchema();

    Assert::assertArrayHasKey('parent_id', $schema, 'Il form eredita quello della Resource: parent_id c\'e\'.');

    Assert::assertInstanceOf(
        Hidden::class,
        $schema['parent_id'],
        "Da qui il padre e' il contesto, non una scelta: chi apre «nuovo» dalla tabella dei "
        ."figli di un criterio sta gia' dicendo di chi sara' figlio, e la relazione lo scrive "
        ."comunque. Un Select visibile sembrerebbe decidere senza decidere, e l'utente se ne "
        .'accorgerebbe solo dopo aver salvato.'
    );
});
