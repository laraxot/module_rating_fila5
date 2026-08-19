<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

use InvalidArgumentException;
use Modules\Rating\DataObjects\RatingData;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

test('costruisce un punteggio valido', function (): void {
    $data = new RatingData(title: 'Ottimo', score: 5, description: 'Nota', userId: 'u-1');

    Assert::assertSame('Ottimo', $data->title);
    Assert::assertSame(5, $data->score);
    Assert::assertSame('Nota', $data->description);
    Assert::assertSame('u-1', $data->userId);
});

test('description e userId sono opzionali', function (): void {
    $data = new RatingData(title: 'Base', score: 0);

    Assert::assertNull($data->description);
    Assert::assertNull($data->userId);
});

test('rifiuta un punteggio fuori dal range 0-5', function (int $score): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Score must be between 0 and 5');

    new RatingData(title: 'Fuori range', score: $score);
})->with([-1, 6, 100]);

test('fromArray mappa user_id su userId', function (): void {
    $data = RatingData::fromArray([
        'title' => 'Da array',
        'score' => 4,
        'description' => 'Descrizione',
        'user_id' => 'u-9',
    ]);

    Assert::assertSame('Da array', $data->title);
    Assert::assertSame(4, $data->score);
    Assert::assertSame('Descrizione', $data->description);
    Assert::assertSame('u-9', $data->userId);
});

test('fromArray normalizza scalari e valori assenti', function (): void {
    $data = RatingData::fromArray([
        'title' => 7,
        'score' => '3',
    ]);

    Assert::assertSame('7', $data->title);
    Assert::assertSame(3, $data->score);
    Assert::assertNull($data->description);
    Assert::assertNull($data->userId);
});

test('fromArray azzera title non scalare e score non numerico', function (): void {
    $data = RatingData::fromArray([
        'title' => ['non', 'scalare'],
        'score' => 'non-numerico',
        'description' => ['non stringa'],
        'user_id' => 12,
    ]);

    Assert::assertSame('', $data->title);
    Assert::assertSame(0, $data->score);
    Assert::assertNull($data->description);
    Assert::assertNull($data->userId);
});
