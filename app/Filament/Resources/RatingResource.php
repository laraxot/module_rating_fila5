<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Modules\Rating\Filament\Resources\RatingResource\Pages\CreateRating;
use Modules\Rating\Filament\Resources\RatingResource\Pages\EditRating;
use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Rating\Models\Rating;
use Modules\Xot\Filament\Resources\XotBaseResource;

class RatingResource extends XotBaseResource
{
    protected static ?string $model = Rating::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRatings::route('/'),
            'create' => CreateRating::route('/create'),
            'edit' => EditRating::route('/{record}/edit'),
        ];
    }
}
