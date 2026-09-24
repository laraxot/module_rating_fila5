<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Modules\Rating\Models\RatingMorph;
use Modules\Xot\Filament\Resources\XotBaseResource;

abstract class BaseRatingMorphResource extends XotBaseResource
{
    protected static ?string $model = RatingMorph::class;
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 77b9106 (.)

    public static function getFormSchema(): array
    {
        return [
            // Campi del form
        ];
    }
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
}
