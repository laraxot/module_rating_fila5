<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
>>>>>>> 88e4240 (.)
use Modules\Rating\Models\Traits\HasRatingsTrait;

/**
 * Anchor per analisi statica: `HasRatingsTrait` va `@use` sugli host cross-modulo
 * (es. `Ptv\Models\BaseScheda`). Nel perimetro Rating non esiste un modello host reale;
 * questa base astratta documenta il contratto senza mappare una tabella.
<<<<<<< HEAD
=======
 *
 * @property-read EloquentCollection<int|string, BaseRating> $ratings_by_id
>>>>>>> 88e4240 (.)
 */
abstract class AbstractRatingsHost extends BaseModel
{
    /** @use HasRatingsTrait<static> */
    use HasRatingsTrait;
}
