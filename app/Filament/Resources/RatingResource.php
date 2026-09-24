<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Rating\Filament\Resources\RatingResource\RelationManagers\ChildrenRelationManager;
=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
use Modules\Rating\Models\Rating;

class RatingResource extends BaseRatingResource
{
    protected static ?string $model = Rating::class;
<<<<<<< HEAD
<<<<<<< HEAD
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
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
}
