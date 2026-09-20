<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingMorphResource\Schemas;

<<<<<<< HEAD
use Filament\Schemas\Components\Component as SchemaComponent;
use Modules\Xot\Filament\Resources\Schemas\XotBaseResourceForm;

class RatingMorphForm extends XotBaseResourceForm
{
    /**
     * @return array<int|string, SchemaComponent>
     */
    public function getFormSchema(): array
    {
        return [
            // Campi del form
        ];
    }
}
=======
class RatingMorphForm extends BaseRatingMorphForm {}
>>>>>>> laraxot/dev
