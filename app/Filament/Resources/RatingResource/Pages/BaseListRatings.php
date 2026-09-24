<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingResource\Pages;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
>>>>>>> e8cf105 (Check & fix styling)
=======
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
>>>>>>> 77b9106 (.)
use Modules\Rating\Filament\Resources\RatingResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

abstract class BaseListRatings extends XotBaseListRecords
{
    protected static string $resource = RatingResource::class;
<<<<<<< HEAD
<<<<<<< HEAD
=======

=======

    /**
     * @return array<string, mixed>
     */
>>>>>>> 77b9106 (.)
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'title' => TextColumn::make('title')
                ->sortable()
                ->searchable(),
            'rule' => TextColumn::make('rule')
                ->badge(),
            'is_disabled' => IconColumn::make('is_disabled')
                ->boolean(),
            'is_readonly' => IconColumn::make('is_readonly')
                ->boolean(),
        ];

        // TextColumn::make('extra_attributes.type'),
        // TextColumn::make('extra_attributes.anno'),

        // TextColumn::make('is_readonly'),
        // TextColumn::make('is_disabled'),
        // ToggleColumn::make('is_readonly'),

        // TextColumn::make('color'),
    }
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
}
