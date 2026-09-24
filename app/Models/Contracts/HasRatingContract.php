<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Rating\Models\Rating;

/** Contract for models that expose the shared ratings relation. */
interface HasRatingContract
{
    /**
     * @return MorphToMany<Rating, Model, MorphPivot, 'pivot'>
     *
     * @phpstan-return MorphToMany<Rating, Model, MorphPivot, 'pivot'>
     */
    public function ratings(): MorphToMany;
=======
=======
>>>>>>> 77b9106 (.)
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;

/**
 * Contract for models that have ratings.
 */
interface HasRatingContract
{
    /** @return MorphToMany<Rating, Model, RatingMorph, 'pivot'> */
    public function ratings(): Relation;
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
}
