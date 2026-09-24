<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
>>>>>>> fd7a600 (.)
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> laraxot/dev
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> e8cf105 (Check & fix styling)
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Mockery\MockInterface;
use Modules\Rating\Models\Rating;
use Modules\Rating\Tests\Fixtures\RatingsHostStub;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

require_once __DIR__.'/../Fixtures/RatingsHostStub.php';

afterEach(function (): void {
    \Mockery::close();
});

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
/**
 * @param array<string, int|string|null> $payload
 *
 * @return HasMany<MorphPivot, RatingsHostStub>&MockInterface
 */
function mockRatingMorphsQuery(int|string $ratingId, array $payload, int $updated = 1): HasMany
{
    /** @var HasMany<MorphPivot, RatingsHostStub>&MockInterface $relation */
    $relation = \Mockery::mock(HasMany::class);
    $relation->shouldReceive('whereIn')->andReturnSelf();
    $relation->shouldReceive('where')->with('rating_id', $ratingId)->andReturnSelf();
    $relation->shouldReceive('update')->once()->with($payload)->andReturn($updated);

    return $relation;
}

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
/*
 * Story Rating/5.145 — refactor: fill/save del pivot ratings.{id}.pivot.{value,note}
 * spostato da CompilaIndennitaResponsabilita (duplicato, parziale, con un cast a 0 buggato)
 * a due metodi generici del trait. Risolve anche il blocker IR/5.140 (issue
 * provtv/module_indennitaresponsabilita_fila5#36) sul pass-through di pivot.note.
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
 *
 * Hotfix 2026-09-16: sync/clear usano ratingMorphs() (model_id + alias|FQCN), non
 * updateExistingPivot solo-alias.
=======
>>>>>>> fd7a600 (.)
=======
 *
 * Hotfix 2026-09-16: sync/clear usano ratingMorphs() (model_id + alias|FQCN), non
 * updateExistingPivot solo-alias.
>>>>>>> e8cf105 (Check & fix styling)
 */
describe('HasRatingsTrait::hydrateRatingsFormData', function (): void {
    test('mappa value e note per ogni riga gia caricata', function (): void {
        $host = new RatingsHostStub();
        $host->setRelation('ratings', collect([
            (object) ['id' => 1, 'pivot' => (object) ['value' => 5, 'note' => null]],
            (object) ['id' => 2, 'pivot' => (object) ['value' => null, 'note' => null]],
        ]));

        $data = $host->hydrateRatingsFormData(['dal' => 'x']);

        Assert::assertSame('x', $data['dal']);
        Assert::assertSame([
            '1' => ['pivot' => ['value' => 5, 'note' => null]],
            '2' => ['pivot' => ['value' => null, 'note' => null]],
        ], $data['ratings']);
    });

    test('rimappa value null + note valorizzata sulla chiave "other" (altro)', function (): void {
        $host = new RatingsHostStub();
        $host->setRelation('ratings', collect([
            (object) ['id' => 3, 'pivot' => (object) ['value' => null, 'note' => 'motivo libero']],
        ]));

        $data = $host->hydrateRatingsFormData([]);

        Assert::assertSame([
            '3' => ['pivot' => ['value' => 'other', 'note' => 'motivo libero']],
        ], $data['ratings']);
    });

    test('non rimappa se value e un numero reale, anche zero', function (): void {
        $host = new RatingsHostStub();
        $host->setRelation('ratings', collect([
            (object) ['id' => 4, 'pivot' => (object) ['value' => 0, 'note' => 'commento']],
        ]));

        $data = $host->hydrateRatingsFormData([]);

        Assert::assertSame([
            '4' => ['pivot' => ['value' => 0, 'note' => 'commento']],
        ], $data['ratings']);
    });
});

describe('HasRatingsTrait::syncRatingsFormData', function (): void {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
    test('scrive value numerico e note invariata via ratingMorphs', function (): void {
        $host = new RatingsHostStub();
        $host->forceFill(['id' => 1001]);
        $host->exists = true;
        $host->forcedHasMany = mockRatingMorphsQuery(7, ['value' => 5, 'note' => 'ok'], 1);
<<<<<<< HEAD
<<<<<<< HEAD
=======
    test('scrive value numerico e note invariata', function (): void {
        /** @var MorphToMany<Rating, RatingsHostStub, MorphPivot, 'pivot'>&MockInterface $relation */
        $relation = \Mockery::mock(MorphToMany::class);
        $relation->shouldReceive('updateExistingPivot')
            ->once()
            ->with(7, ['value' => 5, 'note' => 'ok']);

        $host = new RatingsHostStub();
        $host->forcedMorph = $relation;
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)

        $host->syncRatingsFormData([
            7 => ['pivot' => ['value' => 5, 'note' => 'ok']],
        ]);
    });

    test('normalizza a null la chiave "other" (altro), mai a zero', function (): void {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
        $host = new RatingsHostStub();
        $host->forceFill(['id' => 1002]);
        $host->exists = true;
        $host->forcedHasMany = mockRatingMorphsQuery(8, ['value' => null, 'note' => 'motivo'], 1);
<<<<<<< HEAD
<<<<<<< HEAD
=======
        /** @var MorphToMany<Rating, RatingsHostStub, MorphPivot, 'pivot'>&MockInterface $relation */
        $relation = \Mockery::mock(MorphToMany::class);
        $relation->shouldReceive('updateExistingPivot')
            ->once()
            ->with(8, ['value' => null, 'note' => 'motivo']);

        $host = new RatingsHostStub();
        $host->forcedMorph = $relation;
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)

        $host->syncRatingsFormData([
            8 => ['pivot' => ['value' => 'other', 'note' => 'motivo']],
        ]);
    });

    test('normalizza a null un valore non numerico, mai a zero', function (): void {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
        $host = new RatingsHostStub();
        $host->forceFill(['id' => 1003]);
        $host->exists = true;
        $host->forcedHasMany = mockRatingMorphsQuery(9, ['value' => null], 1);
<<<<<<< HEAD
<<<<<<< HEAD
=======
        /** @var MorphToMany<Rating, RatingsHostStub, MorphPivot, 'pivot'>&MockInterface $relation */
        $relation = \Mockery::mock(MorphToMany::class);
        $relation->shouldReceive('updateExistingPivot')
            ->once()
            ->with(9, ['value' => null]);

        $host = new RatingsHostStub();
        $host->forcedMorph = $relation;
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)

        $host->syncRatingsFormData([
            9 => ['pivot' => ['value' => 'garbage']],
        ]);
    });

    test('value null resta null (nessuna scelta), mai a zero', function (): void {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
        $host = new RatingsHostStub();
        $host->forceFill(['id' => 1004]);
        $host->exists = true;
        $host->forcedHasMany = mockRatingMorphsQuery(10, ['value' => null], 1);
<<<<<<< HEAD
<<<<<<< HEAD
=======
        /** @var MorphToMany<Rating, RatingsHostStub, MorphPivot, 'pivot'>&MockInterface $relation */
        $relation = \Mockery::mock(MorphToMany::class);
        $relation->shouldReceive('updateExistingPivot')
            ->once()
            ->with(10, ['value' => null]);

        $host = new RatingsHostStub();
        $host->forcedMorph = $relation;
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)

        $host->syncRatingsFormData([
            10 => ['pivot' => ['value' => null]],
        ]);
    });
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)

    test('se nessuna pivot esiste per questo host, attach una sola volta', function (): void {
        $host = new RatingsHostStub();
        $host->forceFill(['id' => 1005]);
        $host->exists = true;
        $host->forcedHasMany = mockRatingMorphsQuery(11, ['value' => 3], 0);

        /** @var MorphToMany<Rating, RatingsHostStub, MorphPivot, 'pivot'>&MockInterface $morph */
        $morph = \Mockery::mock(MorphToMany::class);
        $morph->shouldReceive('attach')->once()->with(11, ['value' => 3]);
        $host->forcedMorph = $morph;

        $host->syncRatingsFormData([
            11 => ['pivot' => ['value' => 3]],
        ]);
    });
});

describe('HasRatingsTrait::clearEvaluation / clearRatingsFormData', function (): void {
    test('azzera value e note di tutte le pivot di questo model_id via ratingMorphs', function (): void {
        /** @var HasMany<MorphPivot, RatingsHostStub>&MockInterface $relation */
        $relation = \Mockery::mock(HasMany::class);
        $relation->shouldReceive('update')->once()->with([
            'value' => null,
            'note' => null,
        ])->andReturn(3);

        $host = new RatingsHostStub();
        $host->forceFill(['id' => 9408]);
        $host->exists = true;
        $host->forcedHasMany = $relation;

        $host->clearEvaluation();
    });

    test('clearRatingsFormData delega a clearEvaluation (stesso scope model_id)', function (): void {
        /** @var HasMany<MorphPivot, RatingsHostStub>&MockInterface $relation */
        $relation = \Mockery::mock(HasMany::class);
        $relation->shouldReceive('update')->once()->with([
            'value' => null,
            'note' => null,
        ])->andReturn(1);

        $host = new RatingsHostStub();
        $host->forceFill(['id' => 9409]);
        $host->exists = true;
        $host->forcedHasMany = $relation;

        $host->clearRatingsFormData(null);
    });
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
});
