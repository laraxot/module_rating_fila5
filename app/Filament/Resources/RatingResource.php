<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Modules\Rating\Models\Rating;
use Modules\Rating\Filament\Resources\RatingResource\RelationManagers\ChildrenRelationManager;

class RatingResource extends BaseRatingResource
{
    protected static ?string $model = Rating::class;

    /**
     * @return array<int, class-string>
     */
    public static function getRelations(): array
    {
        return [
            ChildrenRelationManager::class,
        ];
    }
}
