<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Modules\Rating\Models\Rating;
<<<<<<< HEAD
=======
use Modules\Rating\Filament\Resources\RatingResource\RelationManagers\ChildrenRelationManager;
>>>>>>> laraxot/dev

class RatingResource extends BaseRatingResource
{
    protected static ?string $model = Rating::class;
<<<<<<< HEAD
=======

    /**
     * @return array<int, class-string>
     */
    public static function getRelations(): array
    {
        return [
            ChildrenRelationManager::class,
        ];
    }
>>>>>>> laraxot/dev
}
