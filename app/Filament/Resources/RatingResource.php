<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

<<<<<<< HEAD
use Modules\Rating\Filament\Resources\RatingResource\RelationManagers\ChildrenRelationManager;
=======
>>>>>>> 2025498 (.)
use Modules\Rating\Models\Rating;

class RatingResource extends BaseRatingResource
{
    protected static ?string $model = Rating::class;
<<<<<<< HEAD

    /**
     * @return array<int, class-string>
     */
    public static function getRelations(): array
    {
        return [
            ChildrenRelationManager::class,
        ];
    }
=======
>>>>>>> 2025498 (.)
}
