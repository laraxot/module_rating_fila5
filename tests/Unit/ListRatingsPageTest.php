<?php

declare(strict_types=1);

use Modules\Rating\Filament\Resources\RatingResource\Pages\BaseListRatings;
use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;
use ReflectionMethod;

uses(TestCase::class);

/*
 * I metodi pubblici di pagina Filament sono deprecati a favore di `table()`; qui
 * invochiamo via reflection solo per fissare il contratto attuale di BaseListRatings.
 */
test('defines expected table columns without labels', function (): void {
    $page = new ListRatings();
    $method = new ReflectionMethod(BaseListRatings::class, 'getTableColumns');
    /** @var array<string, mixed> $columns */
    $columns = $method->invoke($page);

    Assert::assertSame(['id', 'title', 'rule', 'is_disabled', 'is_readonly'], array_keys($columns));
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
});
