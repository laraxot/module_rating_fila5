<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingMorphResource\Pages;

use Filament\Actions\CreateAction;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Filament\Tables\Columns\TextColumn;
>>>>>>> e8cf105 (Check & fix styling)
=======
use Filament\Tables\Columns\TextColumn;
>>>>>>> 77b9106 (.)
=======
use Filament\Tables\Columns\TextColumn;
>>>>>>> c91c8c3 (.)
use Modules\Rating\Filament\Resources\RatingMorphResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListRatingMorphs extends XotBaseListRecords
{
    protected static string $resource = RatingMorphResource::class;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
    /**
     * @return array<string, mixed>
     */
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'rating' => TextColumn::make('rating')
                ->sortable()
                ->searchable(),
            'ratingable_type' => TextColumn::make('ratingable_type')
                ->label('Type')
                ->sortable(),
            'ratingable_id' => TextColumn::make('ratingable_id')
                ->label('ID')
                ->sortable(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime()
                ->sortable(),
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
