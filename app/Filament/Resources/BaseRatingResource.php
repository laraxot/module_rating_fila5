<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

<<<<<<< HEAD
=======
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Modules\Rating\Enums\RuleEnum;
>>>>>>> laraxot/dev
use Modules\Rating\Models\Rating;
use Modules\Xot\Filament\Resources\XotBaseResource;

abstract class BaseRatingResource extends XotBaseResource
{
    protected static ?string $model = Rating::class;

    /**
<<<<<<< HEAD
     * Le relazioni le dichiara ogni modulo, non questa base.
     *
     * Il RelationManager deve nominare la `RatingResource` **del proprio modulo**
     * (`XotBaseRelationManager::$resource`), che questa classe non puo' conoscere:
     * per questo la base e' astratta e la foglia sta accanto alla Resource, come
     * gia' fanno `Schemas/` e `Tables/`.
     *
     * @return array<int, class-string>
     */
    public static function getRelations(): array
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public static function getFormSchemaOld(): array
>>>>>>> laraxot/dev
    {
        return [];
    }

}
