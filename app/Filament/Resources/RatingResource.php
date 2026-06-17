<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Support\Components\Component;
use Modules\Rating\Enums\RuleEnum;
use Modules\Rating\Filament\Resources\RatingResource\Pages\CreateRating;
use Modules\Rating\Filament\Resources\RatingResource\Pages\EditRating;
use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Rating\Models\Rating;
use Modules\Xot\Filament\Resources\XotBaseResource;

class RatingResource extends BaseRatingResource
{
    protected static ?string $model = Rating::class;

    
}
