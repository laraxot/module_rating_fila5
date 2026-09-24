<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 77b9106 (.)
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Support\Components\Component;
use Modules\Rating\Enums\RuleEnum;
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
use Modules\Rating\Models\Rating;
use Modules\Xot\Filament\Resources\XotBaseResource;

abstract class BaseRatingResource extends XotBaseResource
{
    protected static ?string $model = Rating::class;

    /**
<<<<<<< HEAD
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
    {
        return [];
=======
=======
>>>>>>> 77b9106 (.)
     * @return array<string, Component>
     */
    public static function getFormSchema(): array
    {
        return [
            'extra_attributes.type' => TextInput::make('extra_attributes.type'),
            'extra_attributes.anno' => TextInput::make('extra_attributes.anno'),
            'title' => TextInput::make('title')->autofocus()->required(),
            'color' => ColorPicker::make('color'),
            'rule' => Radio::make('rule')->options(RuleEnum::class),
            'flags' => Section::make()
                ->schema([
                    Toggle::make('is_disabled'),
                    Toggle::make('is_readonly'),
                ]),
            'txt' => RichEditor::make('txt')->columnSpanFull(),
        ];
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
    }
}
