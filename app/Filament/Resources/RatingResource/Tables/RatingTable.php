<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingResource\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\BaseFilter;
use Modules\Xot\Filament\Resources\Tables\XotBaseResourceTable;

/**
 * RatingTable Schema - XotBaseResourceTable Zen Pattern.
 *
 * @see XotBaseResourceTable
 */
class RatingTable extends XotBaseResourceTable
{
    /**
     * @return array<string, Column>
     */
    public function getTableColumns(): array
    {
        return [
            'title' => TextColumn::make('title'),
            'type' => TextColumn::make('type'),
            'anno' => TextColumn::make('anno'),
            'is_disabled' => ToggleColumn::make('is_disabled'),
            'is_readonly' => ToggleColumn::make('is_readonly'),
            'color' => IconColumn::make('color'),
        ];
    }

    /**
     * @return array<string, BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
        ];
    }

    /**
     * @return array<string, Action|ActionGroup>
     */
    public function getTableActions(): array
    {
        return [
            'edit' => EditAction::make(),
        ];
    }

    /**
     * @return array<string, BulkAction|BulkActionGroup>
     */
    public function getTableBulkActions(): array
    {
        return [
            'bulk' => BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ];
    }
}
