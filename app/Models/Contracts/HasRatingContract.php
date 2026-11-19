<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Rating\Models\Rating;

/**
 * Contract for models that have ratings.
 *
 * @phpstan-require-extends Model
 */
interface HasRatingContract
{
    /**
     * `$this` non e' ammesso come TDeclaringModel in un'interfaccia, e `Model` secco e' invariante:
     * l'implementazione (`HasRating`, `$this`) risultava incompatibile. `covariant Model` accetta
     * qualunque host (stesso schema di `UserNotificationsContract`).
     *
     * @return MorphToMany<Rating, covariant Model, \Modules\Rating\Models\RatingMorph, 'pivot'>
     */
    public function ratings(): MorphToMany;
}
