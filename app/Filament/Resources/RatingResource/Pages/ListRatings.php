<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingResource\Pages;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Modules\Rating\Filament\Resources\RatingResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListRatings extends BaseListRatings
{
    protected static string $resource = RatingResource::class;

    
}
