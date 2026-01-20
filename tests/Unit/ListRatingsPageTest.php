<?php

declare(strict_types=1);

use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;

// Business-logic oriented assertions on methods that build table config

describe('ListRatings page config', function (): void {
    beforeEach(function (): void {
        $this->page = new ListRatings();
    });

    it('defines expected table columns without labels', function (): void {
        $columns = $this->page->getTableColumns();
        expect($columns)->toBeArray();
        expect(array_keys($columns))->toEqual(['id', 'title', 'rule', 'is_disabled', 'is_readonly']);
    });

    it('defines default empty filters and header actions', function (): void {
        expect($this->page->getTableFilters())->toBeArray()->toBeEmpty();
        expect($this->page->getTableHeaderActions())->toBeArray()->toBeEmpty();
    });

    it('defines view/edit/delete actions and bulk delete', function (): void {
        $actions = $this->page->getTableActions();
        expect($actions)->toHaveKeys(['view', 'edit', 'delete']);

        $bulk = $this->page->getTableBulkActions();
        expect($bulk)->toHaveKey('delete');
    });
});
