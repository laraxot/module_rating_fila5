<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingMorphResource\Pages;

use Filament\Actions\CreateAction;
<<<<<<< HEAD
=======
use Filament\Tables\Columns\TextColumn;
>>>>>>> laraxot/dev
use Modules\Rating\Filament\Resources\RatingMorphResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListRatingMorphs extends XotBaseListRecords
{
    protected static string $resource = RatingMorphResource::class;

<<<<<<< HEAD
=======
    /**
     * @return array<string, mixed>
     */
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

>>>>>>> laraxot/dev
    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
