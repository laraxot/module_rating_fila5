<?php

declare(strict_types=1);

use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

test('defines expected table columns without labels', function (): void {
<<<<<<< HEAD
    $page = new ListRatings;
=======
    $page = new ListRatings();
>>>>>>> laraxot/dev
    $columns = $page->getTableColumns();

    Assert::assertSame(['id', 'title', 'rule', 'is_disabled', 'is_readonly'], array_keys($columns));
});

test('defines default empty filters and header actions', function (): void {
<<<<<<< HEAD
    $page = new ListRatings;
=======
    $page = new ListRatings();
>>>>>>> laraxot/dev

    Assert::assertSame([], $page->getTableFilters());
    Assert::assertNotEmpty($page->getTableHeaderActions());
});

test('defines view edit delete actions and bulk delete', function (): void {
<<<<<<< HEAD
    $page = new ListRatings;
=======
    $page = new ListRatings();
>>>>>>> laraxot/dev
    $actions = $page->getTableActions();
    $bulk = $page->getTableBulkActions();

    Assert::assertArrayHasKey('view', $actions);
    Assert::assertArrayHasKey('edit', $actions);
    Assert::assertArrayHasKey('delete', $actions);
    Assert::assertArrayHasKey('delete', $bulk);
});
