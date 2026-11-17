<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Rating\Models\Rating;

/**
 * Contract for models that have ratings.
 *
 * @phpstan-require-extends Model
 */
interface HasRatingContract
{
    /**
     * Declaring model is Model: hosts are Eloquent models; $this on interfaces
     * is not a valid TDeclaringModel for MorphToMany.
     *
     * @return MorphToMany<Rating, Model, \Modules\Rating\Models\RatingMorph, 'pivot'>
     */
    public function ratings(): MorphToMany;
}
