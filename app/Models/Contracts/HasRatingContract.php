<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Contract for models that have ratings.
 */
interface HasRatingContract
{
    public function ratings(): Relation;
}
