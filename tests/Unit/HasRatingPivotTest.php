<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Rating\Models\BaseModel;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\Rating\Models\Traits\HasRating;
use Modules\Rating\Tests\TestCase;

/**
 * Il pivot di `HasRating::ratings()` e' `RatingMorph` (colonne `user_id`, `points`, ...).
 * La relazione si costruisce senza query: nessuna scrittura sul DB.
 */
class HasRatingPivotTest extends TestCase
{
    /**
     * Guardia di contratto: oggi la convenzione di `morphToManyX()` risolve gia' `RatingMorph`, quindi questo test
     * non prova il parametro `pivotClass` (lo prova il test sotto) ma fallisce se `ratings()` cambia pivot.
     */
    public function testRatingsRelationUsesRatingMorphAsPivotClass(): void
    {
        $host = new class extends BaseModel
        {
            use HasRating;
        };

        $relation = $host->ratings();

        $this->assertSame(Rating::class, $relation->getRelated()::class);
        $this->assertSame(RatingMorph::class, $relation->getPivotClass());
    }

    /**
     * `pivotClass` deve prevalere sul pivot dedotto per convenzione: con un pivot diverso da `RatingMorph`
     * l'effetto e' osservabile (senza il parametro la relazione tornerebbe a `RatingMorph`).
     */
    public function testExplicitPivotClassOverridesTheConventionPivot(): void
    {
        $stubPivot = new class extends MorphPivot {};
        $host = new class extends BaseModel
        {
            use HasRating;
        };

        $conventional = $host->morphToManyX(Rating::class, 'model');
        $explicit = $host->morphToManyX(Rating::class, 'model', pivotClass: $stubPivot::class);

        $this->assertSame(RatingMorph::class, $conventional->getPivotClass());
        $this->assertSame($stubPivot::class, $explicit->getPivotClass());
    }
}
