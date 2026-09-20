<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Rating\Filament\Actions\Table;

<<<<<<< HEAD
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Actions\XotBaseAction;

class BetTableAction extends XotBaseAction
=======
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;

class BetTableAction extends Action
>>>>>>> laraxot/dev
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel();
        $this->label('')
            ->tooltip(trans('rating:txt.bet'))
            ->modalWidth('xl')
<<<<<<< HEAD
            ->schema(fn (): array => [
=======
            ->schema(static fn (Action $action): array => [
>>>>>>> laraxot/dev
                TextInput::make('aa'),
            ]);
    }

    public static function getDefaultName(): ?string
    {
        return 'bet_action';
    }
}
