<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Rating\Models\Rating;
=======
use Illuminate\Database\Eloquent\Relations\Relation;
>>>>>>> laraxot/dev

/**
 * Contract for models that have ratings.
 */
interface HasRatingContract
{
    /** @return MorphToMany<Rating, Model, MorphPivot, 'pivot'> */
    public function ratings(): MorphToMany;
}
