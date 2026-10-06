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
        
        $tooltip = trans('rating:txt.bet');
        if (is_string($tooltip)) {
            $this->label('')
                ->tooltip($tooltip)
                ->modalWidth('xl')
                ->schema(static fn (Action $action): array => [
                    TextInput::make('aa'),
                ]);
        }
    }

    public static function getDefaultName(): ?string
    {
        return 'bet_action';
    }
}
