<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

use Modules\Rating\Models\Traits\HasRating;

/**
 * In-module host so HasRating stays analysed under `phpstan Modules/Rating`.
 * Domain hosts (Blog Article/Profile) keep using the trait directly.
 */
abstract class RateableHost extends BaseModel
{
    use HasRating;
}
