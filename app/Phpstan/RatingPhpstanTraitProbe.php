<?php

declare(strict_types=1);

namespace Modules\Rating\Phpstan;

use Illuminate\Database\Eloquent\Model;
use Modules\Rating\Models\Traits\HasRating;

/** Host probe per analisi PHPStan del trait HasRating. */
final class RatingPhpstanTraitProbe extends Model
{
    use HasRating;

    protected $table = 'phpstan_rating_trait_probe';
}
