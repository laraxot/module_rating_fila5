<?php

declare(strict_types=1);

namespace Modules\Rating\Actions\HasRating;

use Modules\Rating\Models\Contracts\HasRatingContract;
use Spatie\QueueableAction\QueueableAction;

/**
 * Somma dei voti (pivot con user_id) di un model, per criterio o totale.
 *
 * @contract docs/contracts/get-sum-by-model-rating-id-action.md
 */
class GetSumByModelRatingIdAction
{
    use QueueableAction;

    /**
     * Undocumented function.
     */
    public function execute(HasRatingContract $model, ?string $rating_id = null): float
    {
        $opts = $model->ratings()
            ->wherePivot('user_id', '!=', null);
        if (null !== $rating_id) {
            $opts = $opts->wherePivot('rating_id', $rating_id);
        }
        $sum = $opts->sum('rating_morph.value');

        return is_numeric($sum) ? (float) $sum : 0.0;
    }
}
