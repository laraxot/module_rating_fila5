<?php

declare(strict_types=1);

<<<<<<< HEAD
use Filament\Tables\Table;
use Modules\Rating\Filament\Resources\RatingResource;
use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

test('ListRatings uses correct resource', function (): void {
    $page = new ListRatings();
    Assert::assertSame(RatingResource::class, $page::getResource());
});

// Nota: getTableColumns() e' @deprecated in Filament v4 ("Override the `table()` method
// to configure the table"), quindi qui si ispeziona la Table costruita da table()/Table::make()
// invece di chiamare il metodo deprecato direttamente (stesso pattern gia' validato in
// RatingFilamentExtendedTest.php, story 2.3.phpstan-rating-tail-contracts).
//
// getTableFilters()/getTableHeaderActions()/getTableActions()/getTableBulkActions() non sono
// invece overridati da BaseListRatings: restano l'implementazione di default del trait
// HasXotTable. Passando per HasXotTable::table(), il legacy-hook-detector
// (HasXotTable::invokeTableHook()) salta di proposito l'invocazione quando il metodo e'
// ancora quello ereditato dal trait (per non duplicare i default nativi di Filament),
// quindi $table->getHeaderActions()/getRecordActions()/getToolbarActions() risultano vuoti
// anche se i vecchi metodi deprecati chiamati direttamente su $page non lo erano. Riscriverli
// contro la Table produrrebbe falsi negativi: non rientrano nello scope PHPStan/deprecazione
// di questa story e non sono stati riproposti.
test('defines expected table columns without labels', function (): void {
    $page = new ListRatings();
    $table = $page->table(Table::make($page));

    Assert::assertSame(['id', 'title', 'rule', 'is_disabled', 'is_readonly'], array_keys($table->getColumns()));
=======
use Modules\Rating\Filament\Resources\RatingResource\Pages\BaseListRatings;
use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Rating\Filament\Resources\RatingResource\Tables\RatingsTable;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;
use ReflectionMethod;

uses(TestCase::class);

/*
 * I metodi pubblici di pagina Filament sono deprecati a favore di `table()`; qui
 * invochiamo via reflection solo per fissare il contratto attuale di BaseListRatings.
 */
test('page no longer owns the column set', function (): void {
    // Le colonne sono state spostate nelle classi sotto Tables/: qui resta solo
    // l'ereditarieta' da XotBaseListRecords, che non ne dichiara nessuna.
    $page = new ListRatings();
    $method = new ReflectionMethod(BaseListRatings::class, 'getTableColumns');
    /** @var array<string, mixed> $columns */
    $columns = $method->invoke($page);

    Assert::assertSame([], array_keys($columns));
});

test('the column set lives in RatingsTable', function (): void {
    $columns = (new RatingsTable())->getTableColumns();

    Assert::assertSame([
        'id',
        'title',
        'slug',
        'rule',
        'is_disabled',
        'is_readonly',
        'order_column',
        'created_at',
        'updated_at',
    ], array_keys($columns));
});

test('defines default empty filters and header actions', function (): void {
    $page = new ListRatings();
    $filtersMethod = new ReflectionMethod($page, 'getTableFilters');
    $headerMethod = new ReflectionMethod($page, 'getTableHeaderActions');

    /** @var array<string, mixed> $filters */
    $filters = $filtersMethod->invoke($page);
    /** @var array<string, mixed> $headerActions */
    $headerActions = $headerMethod->invoke($page);

    Assert::assertSame([], $filters);
    Assert::assertNotEmpty($headerActions);
});

test('defines view edit delete actions and bulk delete', function (): void {
    $page = new ListRatings();
    $actionsMethod = new ReflectionMethod($page, 'getTableActions');
    $bulkMethod = new ReflectionMethod($page, 'getTableBulkActions');

    /** @var array<string, mixed> $actions */
    $actions = $actionsMethod->invoke($page);
    /** @var array<string, mixed> $bulk */
    $bulk = $bulkMethod->invoke($page);

    Assert::assertArrayHasKey('view', $actions);
    Assert::assertArrayHasKey('edit', $actions);
    Assert::assertArrayHasKey('delete', $actions);
    Assert::assertArrayHasKey('delete', $bulk);
>>>>>>> laraxot/dev
});
