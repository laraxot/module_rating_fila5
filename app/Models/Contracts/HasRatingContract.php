<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Contract for models that have ratings.
 * 
 * @phpstan-ignore-next-line generics.notSubtype
 */
interface HasRatingContract
{
<<<<<<< Updated upstream
=======
    /**
     * @return MorphToMany<Rating, \Illuminate\Database\Eloquent\Relations\MorphPivot>
     */
>>>>>>> Stashed changes
    public function ratings(): MorphToMany;
}
