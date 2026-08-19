<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

use Modules\Rating\Enums\SupportedLocale;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

test('espone i due locali supportati', function (): void {
    Assert::assertSame(['it', 'en'], array_column(SupportedLocale::cases(), 'value'));
});

test('fromString risolve i valori noti', function (string $value, SupportedLocale $expected): void {
    Assert::assertSame($expected, SupportedLocale::fromString($value));
})->with([
    ['it', SupportedLocale::IT],
    ['en', SupportedLocale::EN],
]);

test('fromString ricade su IT per i valori sconosciuti', function (string $value): void {
    Assert::assertSame(SupportedLocale::IT, SupportedLocale::fromString($value));
})->with(['', 'fr', 'IT', 'it-IT', 'qualsiasi-cosa']);

test('getLabel restituisce la traduzione, non la chiave', function (SupportedLocale $locale, string $expected): void {
    $label = $locale->getLabel();

    Assert::assertSame($expected, $label);
    Assert::assertStringStartsNotWith('fix:', $label, 'prefisso fix: = traduzione mancante in lang/');
})->with([
    [SupportedLocale::IT, 'Italiano'],
    [SupportedLocale::EN, 'Inglese'],
]);

test('toArray indicizza i casi per valore', function (): void {
    $locales = SupportedLocale::toArray();

    Assert::assertArrayHasKey('it', $locales);
    Assert::assertArrayHasKey('en', $locales);
    Assert::assertCount(2, $locales);
});
