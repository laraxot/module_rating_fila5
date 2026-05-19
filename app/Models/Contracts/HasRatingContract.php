<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Contract for models that have ratings.
 */
interface HasRatingContract
{
    public function ratings(): MorphToMany;
}
