<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Modules\Rating\Models\Rating;
use Modules\Xot\Filament\Resources\XotBaseResource;

abstract class BaseRatingResource extends XotBaseResource
{
    protected static ?string $model = Rating::class;
}
