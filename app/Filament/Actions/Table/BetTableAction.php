<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Rating\Filament\Actions\Table;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;

class BetTableAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel();
        $this->label('')
            ->tooltip(is_string($tooltip = trans('rating:txt.bet')) ? $tooltip : null)
            ->modalWidth('xl')
            ->schema(fn (Action $action): array => [
                TextInput::make('aa'),
            ]);
    }

    public static function getDefaultName(): ?string
    {
        return 'bet_action';
    }
}
