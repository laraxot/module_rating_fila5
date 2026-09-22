<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Modules\Rating\Models\BaseRating;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\Rating\Tests\Fixtures\RatingsHostStub;
use Modules\Rating\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

require_once __DIR__.'/../Fixtures/RatingsHostStub.php';

/**
 * Un rating con il suo pivot gia' caricato, senza toccare il database.
 */
function ratingWithPivot(int $id, string $title, ?int $value): Rating
{
    $rating = new Rating;
    $rating->setRawAttributes([
        'id' => $id,
        'title' => $title,
    ]);

    $pivot = new RatingMorph;
    $pivot->setRawAttributes([
        'value' => $value,
        'note' => null,
    ]);
    $rating->setRelation('pivot', $pivot);

    return $rating;
}

function hostWithRatings(): RatingsHostStub
{
    $host = new RatingsHostStub;
    $host->setRelation('ratings', new EloquentCollection([
        ratingWithPivot(52, 'Obiettivo A', 57),
        ratingWithPivot(34, 'Obiettivo B', 1),
    ]));

    return $host;
}

describe('HasRatingsTrait ratings_by_id', function (): void {
    test('la relazione ratings e\' indicizzata per posizione, non per id: data_get per id non trova nulla', function (): void {
        $host = hostWithRatings();

        Assert::assertSame(57, data_get($host, 'ratings.0.pivot.value'));
        Assert::assertNull(data_get($host, 'ratings.52.pivot.value'));
    });

    test('ratings_by_id espone la stessa collection indicizzata per id del rating', function (): void {
        $host = hostWithRatings();

        Assert::assertSame([52, 34], $host->ratings_by_id->keys()->all());
        Assert::assertSame(57, data_get($host, 'ratings_by_id.52.pivot.value'));
        Assert::assertSame(1, data_get($host, 'ratings_by_id.34.pivot.value'));
        Assert::assertNull(data_get($host, 'ratings_by_id.99.pivot.value'));
    });

    test('ratings_by_id senza ratings caricati e\' una collection vuota', function (): void {
        $host = new RatingsHostStub;
        $host->setRelation('ratings', new EloquentCollection);

        Assert::assertSame([], $host->ratings_by_id->all());
    });

    test('ratingValuePath costruisce il percorso data_get del valore pivot di un rating', function (): void {
        $rating = ratingWithPivot(52, 'Obiettivo A', 57);

        Assert::assertSame('ratings_by_id.52.pivot.value', RatingsHostStub::ratingValuePath($rating));
        Assert::assertSame('ratings_by_id.52.pivot.note', RatingsHostStub::ratingValuePath($rating, 'note'));
    });

    test('ratingValuePath risolve davvero il valore sull\'host', function (): void {
        $host = hostWithRatings();
        $rating = $host->ratings->first();

        if (! $rating instanceof BaseRating) {
            Assert::fail('hostWithRatings() deve popolare almeno un rating');
        }

        Assert::assertSame(57, data_get($host, RatingsHostStub::ratingValuePath($rating)));
    });
});
