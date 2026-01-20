<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Rating\Models\Rating;

/**
 * --.
 */
interface HasRatingContract
{
    /**
     * @return MorphToMany<Rating, Rating|Model>
     */
    public function ratings(): MorphToMany;
}

/*
 * @property-read string $url

interface Page
{
    public function getUrlAttribute(): string;
}
*/
