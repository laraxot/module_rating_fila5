<?php

declare(strict_types=1);

namespace Modules\Rating\Actions\HasRating;

use Modules\Rating\Models\Contracts\HasRatingContract;
use Spatie\QueueableAction\QueueableAction;

class GetCountByModelRatingIdAction
{
    use QueueableAction;

    /**
     * Undocumented function.
     */
    public function execute(HasRatingContract $model, ?string $rating_id = null): float
    {
        $opts = $model->ratings()
<<<<<<< HEAD
            ->wherePivot('user_id', '!=', null);
=======
            ->wherePivotNotNull('user_id');
>>>>>>> 77b9106 (.)
        if (null !== $rating_id) {
            $opts = $opts->wherePivot('rating_id', $rating_id);
        }

        return $opts->count('rating_morph.value');
    }
}
