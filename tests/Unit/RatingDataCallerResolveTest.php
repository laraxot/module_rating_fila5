<?php

declare(strict_types=1);

namespace Modules\IndennitaResponsabilita\Filament\Resources;

use Modules\IndennitaResponsabilita\Models\Rating as IrRating;
use Modules\Rating\Datas\RatingData;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;
use RuntimeException;

/**
 * Probe nello stesso namespace Filament\Resources dell'IR Resource:
 * il resolver deve trovare questo frame statico.
 */
final class RatingDataCallerResolveProbe
{
    public static function resolve(): string
    {
        return RatingData::resolveRatingClassFromCaller();
    }
}

uses(TestCase::class);

describe('RatingData::resolveRatingClassFromCaller (story 5.230)', function (): void {
    test('da namespace Filament\\Resources IR risolve Models\\Rating IR', function (): void {
        Assert::assertSame(IrRating::class, RatingDataCallerResolveProbe::resolve());
    });

    test('chiamata diretta senza caller modulo lancia RuntimeException', function (): void {
        RatingData::resolveRatingClassFromCaller();
    })->throws(RuntimeException::class);
});
