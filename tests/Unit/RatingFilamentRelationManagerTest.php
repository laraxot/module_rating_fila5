<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

use Filament\Tables\Columns\Column;
use Filament\Tables\Table;
use Modules\Rating\Filament\RelationManagers\RatingsRelationManager;
use Modules\Rating\Filament\Resources\HasRatingResource\RelationManagers\RatingsRelationManager as HasRatingRatingsRelationManager;
use Modules\Rating\Tests\Fixtures\Models\RatingsHost;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

afterEach(function (): void {
    \Mockery::close();
});

/**
 * Il relation manager vive dentro la pagina del record: `ownerRecord` e' la proprieta' che
 * Livewire riempie al mount, e `table()` la legge (`getModelClass()` -> `getRelationship()`).
 * Qui si assegna l'owner come farebbe il mount, con un host che risolve `ratings()`.
 *
 * @see Modules/Rating/docs/testing-and-coverage.md
 *
 * @return list<string>
 */
function ratingRelationManagerColumnNames(RatingsRelationManager|HasRatingRatingsRelationManager $manager): array
{
    $manager->ownerRecord = new RatingsHost;

    $table = $manager->table(Table::make($manager));

    return array_values(array_map(
        static fn (Column $column): string => $column->getName(),
        $table->getColumns(),
    ));
}

test('RatingsRelationManager dichiara colonne pivot e azioni CRUD', function (): void {
    $manager = new RatingsRelationManager;

    Assert::assertSame('ratings', $manager::getRelationshipName());

    $names = ratingRelationManagerColumnNames($manager);

    Assert::assertSame(
        ['id', 'title', 'pivot.user.name', 'value', 'is_winner', 'reward', 'updated_at'],
        $names,
    );
});

test('HasRatingResource RatingsRelationManager allinea lo schema tabella', function (): void {
    $manager = new HasRatingRatingsRelationManager;

    Assert::assertSame('ratings', $manager::getRelationshipName());

    $names = ratingRelationManagerColumnNames($manager);

    Assert::assertContains('id', $names);
    Assert::assertContains('title', $names);
    Assert::assertContains('value', $names);
    Assert::assertContains('is_winner', $names);
});
