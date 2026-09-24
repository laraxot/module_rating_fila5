<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingResource\Tables;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\BaseFilter;
use Modules\Xot\Filament\Resources\Tables\XotBaseResourceTable;

/**
 * Tabella rating condivisa tra moduli che estendono BaseRatingResource.
 *
 * Le classi concrete nei moduli figli estendono questa base e sovrascrivono
 * i metodi getTable*() quando l'UI differisce.
 */
abstract class BaseRatingsTable extends XotBaseResourceTable
{
    /**
     * @return array<string, Column>
     */
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')->sortable(),
            'title' => TextColumn::make('title')->searchable()->sortable(),
            'slug' => TextColumn::make('slug')->searchable()->sortable(),
            'rule' => TextColumn::make('rule')->badge()->sortable(),
            'is_disabled' => TextColumn::make('is_disabled')->badge()->sortable(),
            'is_readonly' => TextColumn::make('is_readonly')->badge()->sortable(),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            // order_column è interno — usato solo per reordering via HasXotTable::applyReorderable()
            // Non visibile nell'UI utente (vedi story 5.97 e 5.98):
            // 'order_column' => TextColumn::make('order_column')->sortable(),
=======
            'order_column' => TextColumn::make('order_column')->sortable(),
>>>>>>> e8cf105 (Check & fix styling)
=======
            'order_column' => TextColumn::make('order_column')->sortable(),
>>>>>>> 77b9106 (.)
=======
            'order_column' => TextColumn::make('order_column')->sortable(),
>>>>>>> c91c8c3 (.)
            'created_at' => TextColumn::make('created_at')->dateTime()->sortable(),
            'updated_at' => TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)

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
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
}
