<?php

declare(strict_types=1);

namespace Modules\Rating\Enums;

use Modules\Xot\Traits\EnumTrait;

enum SupportedLocale: string
{
    use EnumTrait;

    case IT = 'it';
    case EN = 'en';

    /**
     * Create from string value.
     */
    public static function fromString(string $value): self
    {
        return match ($value) {
            'it' => self::IT,
            'en' => self::EN,
            default => self::IT,
        };
    }

<<<<<<< HEAD
=======
    /**
     * @phpstan-return list<string>
     */
    public static function getSearchable(): array
    {
        return parent::getSearchable(); // @phpstan-ignore all
    }

    /**
     * @phpstan-return array<string, \Filament\Forms\Components\TextInput>
     */
    public static function getFormSchema(): array
    {
        return parent::getFormSchema(); // @phpstan-ignore all
    }

    /**
     * @phpstan-return array<string, callable(\Illuminate\Database\Schema\Blueprint): void>
     */
    public static function getColumnDefinitions(): array
    {
        return parent::getColumnDefinitions(); // @phpstan-ignore all
    }

    /**
     * @phpstan-return list<string>
     */
    public static function getColumnNames(): array
    {
        return parent::getColumnNames(); // @phpstan-ignore all
    }

    /**
     * @phpstan-return array<string, callable(\Illuminate\Database\Schema\Blueprint): void>
     */
    public static function getColumnDefinitionMap(): array
    {
        return parent::getColumnDefinitionMap(); // @phpstan-ignore all
    }
>>>>>>> laraxot/dev
}
