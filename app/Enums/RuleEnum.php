<?php

declare(strict_types=1);

namespace Modules\Rating\Enums;

use Filament\Support\Contracts\HasLabel;

enum RuleEnum: string implements HasLabel
{
    case Null = '';
    case ZeroFive = 'numeric|min:0|max:5';
    case ZeroOrMin4Max25 = 'min:0|max:25|not_in:1,2,3';

    public function getLabel(): string
    {
        return (string) __('rating::enums.'.$this->name.'.label');

        // or
        /*
        return match ($this) {
            self::Draft => 'Draft',
            self::Reviewing => 'Reviewing',
            self::Published => 'Published',
            self::Rejected => 'Rejected',
        };
        */
    }
}
