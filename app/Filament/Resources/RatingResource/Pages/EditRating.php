<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\Rating\Filament\Resources\RatingResource;

class EditRating extends BaseEditRating
{
    public static string $resource = RatingResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
