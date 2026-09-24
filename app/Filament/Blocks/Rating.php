<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\App;
use Modules\Rating\Datas\RatingData;
use Modules\Rating\Enums\SupportedLocale;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;

class Rating extends Block
{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public const string BLOCK_TYPE = 'rating';
=======
    public const BLOCK_TYPE = 'rating';
>>>>>>> e8cf105 (Check & fix styling)
=======
    public const BLOCK_TYPE = 'rating';
>>>>>>> 77b9106 (.)
=======
    public const BLOCK_TYPE = 'rating';
>>>>>>> c91c8c3 (.)

    /**
     * Create a new rating block.
     */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public static function create(): static
    {
        return static::make(self::BLOCK_TYPE)
=======
    public static function create(): Block
    {
        return parent::make(self::BLOCK_TYPE)
>>>>>>> e8cf105 (Check & fix styling)
=======
    public static function create(): Block
    {
        return parent::make(self::BLOCK_TYPE)
>>>>>>> 77b9106 (.)
=======
    public static function create(): Block
    {
        return parent::make(self::BLOCK_TYPE)
>>>>>>> c91c8c3 (.)
            ->schema([
                TextInput::make('title')
                    ->label('Titolo')
                    ->required(),

                TextInput::make('description')
                    ->label('Descrizione'),

                Toggle::make('disabled')
                    ->label('Disabilitato')
                    ->default(false),
            ])
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            ->label(static function (): string {
=======
            ->label(function (): string {
>>>>>>> e8cf105 (Check & fix styling)
=======
            ->label(function (): string {
>>>>>>> 77b9106 (.)
=======
            ->label(function (): string {
>>>>>>> c91c8c3 (.)
                $locale = App::getLocale();
                $supportedLocale = SupportedLocale::fromString($locale);

                return sprintf('Rating (%s)', $supportedLocale->getLabel());
            });
    }

    /**
     * Create rating data from form data.
     *
     * @param array<string,mixed> $data
     * @param array<string,mixed> $data
     */
    public static function createFromFormData(array $data): RatingData
    {
        return RatingData::fromArray($data);
    }

    /**
     * Create a new rating block with advanced options.
     *
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     * @param array<string, string>|null $options Chiave = vista, valore = etichetta; se null li fornisce GetViewBlocksOptionsByTypeAction
=======
     * @param array<string,mixed> $options
     * @param array<string,mixed> $options
>>>>>>> e8cf105 (Check & fix styling)
=======
     * @param array<string,mixed> $options
     * @param array<string,mixed> $options
>>>>>>> 77b9106 (.)
=======
     * @param array<string,mixed> $options
     * @param array<string,mixed> $options
>>>>>>> c91c8c3 (.)
     */
    public static function createAdvanced(
        string $name = self::BLOCK_TYPE,
        string $context = 'form',
        ?array $options = null,
    ): Block {
        $blockOptions = $options ?? app(GetViewBlocksOptionsByTypeAction::class)
            ->execute(self::BLOCK_TYPE, true);

        return Block::make($name)
            ->schema([
                Radio::make('view')
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                    ->options($blockOptions),
=======
                    ->options(is_array($blockOptions) ? array_map(fn ($value) => is_scalar($value) ? (string) $value : '', $blockOptions) : []),
>>>>>>> e8cf105 (Check & fix styling)
=======
                    ->options(is_array($blockOptions) ? array_map(fn ($value) => is_scalar($value) ? (string) $value : '', $blockOptions) : []),
>>>>>>> 77b9106 (.)
=======
                    ->options(is_array($blockOptions) ? array_map(fn ($value) => is_scalar($value) ? (string) $value : '', $blockOptions) : []),
>>>>>>> c91c8c3 (.)

                Repeater::make('ratings')
                    ->visible(fn (Get $get): bool => $get('locale') === App::getLocale())
                    ->relationship()
                    ->schema([
                        TextInput::make('id')->disabled(),
                        TextInput::make('title')->required(),
                        ColorPicker::make('color'),
                        SpatieMediaLibraryFileUpload::make('rating')
                            ->collection('rating'),
                    ])
                    ->reorderableWithButtons()
                    ->reorderableWithDragAndDrop(true)
                    ->columnSpanFull()
                    ->columns(4)
                    ->live(),
            ])
            ->columns(1);
    }
}
