<?php

declare(strict_types=1);

use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Rating\Tests\Support\Ensure;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

describe('ListRatings page config', function (): void {
    beforeEach(function (): void {
        /** @var TestCase $this */
        $this->page = new ListRatings;
    });

    it('defines expected table columns without labels', function (): void {
        /** @var TestCase $this */
        $page = $this->page;
        Assert::assertInstanceOf(ListRatings::class, $page);
        $columns = $page->getTableColumns();
        ratingEnsure(array_keys($columns))->toEqual(['id', 'title', 'rule', 'is_disabled', 'is_readonly']);
    });

    it('defines default empty filters and header actions', function (): void {
        /** @var TestCase $this */
        $page = $this->page;
        Assert::assertInstanceOf(ListRatings::class, $page);
        ratingEnsure($page->getTableFilters())->toBeEmpty();

        $method = new ReflectionMethod(ListRatings::class, 'getTableHeaderActions');
        $method->setAccessible(true);

        ratingEnsure($method->invoke($page))->toBeEmpty();
    });

    it('defines view/edit/delete actions and bulk delete', function (): void {
        /** @var TestCase $this */
        $page = $this->page;
        Assert::assertInstanceOf(ListRatings::class, $page);
        $actions = $page->getTableActions();
        ratingEnsure($actions)->toHaveKeys(['view', 'edit', 'delete']);

        $bulk = $page->getTableBulkActions();
        ratingEnsure($bulk)->toHaveKey('delete');
    });
});
