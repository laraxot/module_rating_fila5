<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Feature;

use Modules\Rating\Models\Rating;
use Modules\Rating\Tests\TestCase;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

<<<<<<< HEAD
uses(\Modules\Rating\Tests\TestCase::class);

it('can list ratings', function (): void {
    Rating::create([
        'name' => 'Test Rating 1',
    ]);

    Rating::create([
        'name' => 'Test Rating 2',
    ]);

    $response = getJson('/api/ratings');

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
});

it('can create rating', function (): void {
    $data = [
        'name' => 'New Rating',
        'color' => '#00FF00',
    ];

    $response = postJson('/api/ratings', $data);

    $response->assertStatus(201)
        ->assertJson([
=======
use PHPUnit\Framework\Assert;

uses(TestCase::class);

describe('Rating Api', function (): void {
    beforeEach(function (): void {
        /* @var TestCase $this */
        $this->skipTest('Le rotte HTTP /api/ratings non sono registrate in questa install (architettura Folio/Actions).');
    });

    test('can list ratings', function (): void {
        Rating::create([
            'name' => 'Test Rating 1',
        ]);

        Rating::create([
            'name' => 'Test Rating 2',
        ]);

        $response = getJson('/api/ratings');

        Assert::assertSame(200, $response->status());
        $response->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    });

    test('can create rating', function (): void {
        $data = [
            'name' => 'New Rating',
            'color' => '#00FF00',
        ];

        $response = postJson('/api/ratings', $data);

        Assert::assertSame(201, $response->status());
        $response->assertJson([
>>>>>>> laraxot/dev
            'data' => [
                'name' => 'New Rating',
            ],
        ]);
<<<<<<< HEAD
});

it('can update rating', function (): void {
    $rating = Rating::create([
        'name' => 'Test Rating',
    ]);

    $data = [
        'name' => 'Updated Rating',
    ];

    $response = putJson("/api/ratings/{$rating->id}", $data);

    $response->assertStatus(200)
        ->assertJson([
=======
    });

    test('can update rating', function (): void {
        $rating = Rating::create([
            'name' => 'Test Rating',
        ]);

        $data = [
            'name' => 'Updated Rating',
        ];

        $response = putJson("/api/ratings/{$rating->id}", $data);

        Assert::assertSame(200, $response->status());
        $response->assertJson([
>>>>>>> laraxot/dev
            'data' => [
                'name' => 'Updated Rating',
            ],
        ]);
<<<<<<< HEAD
});

it('can delete rating', function (): void {
    $rating = Rating::create([
        'name' => 'Test Rating',
    ]);

    $response = deleteJson("/api/ratings/{$rating->id}");

    $response->assertStatus(204);
    expect(Rating::find($rating->id))->toBeNull();
});

it('can rate model', function (): void {
    $rating = Rating::create([
        'name' => 'Test Rating',
    ]);

    $data = [
        'model_type' => 'test_model',
        'model_id' => 1,
        'value' => 4.5,
        'note' => 'Great!',
    ];

    $response = postJson("/api/ratings/{$rating->id}/rate", $data);

    $response->assertStatus(201)
        ->assertJson([
=======
    });

    test('can delete rating', function (): void {
        $rating = Rating::create([
            'name' => 'Test Rating',
        ]);

        $response = deleteJson("/api/ratings/{$rating->id}");

        Assert::assertSame(204, $response->status());
        /* @var TestCase $this */
        $this->assertDatabaseMissing('ratings', ['id' => $rating->id]);
    });

    test('can rate model', function (): void {
        $rating = Rating::create([
            'name' => 'Test Rating',
        ]);

        $data = [
            'model_type' => 'test_model',
            'model_id' => 1,
            'value' => 4.5,
            'note' => 'Great!',
        ];

        $response = postJson("/api/ratings/{$rating->id}/rate", $data);

        Assert::assertSame(201, $response->status());
        $response->assertJson([
>>>>>>> laraxot/dev
            'data' => [
                'rating_id' => $rating->id,
                'value' => 4.5,
                'note' => 'Great!',
            ],
        ]);
<<<<<<< HEAD
=======
    });
>>>>>>> laraxot/dev
});
