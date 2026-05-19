<?php

declare(strict_types=1);

namespace Modules\Rating\Actions\HasRating;

use Modules\Rating\Models\Contracts\HasRatingContract;
use Spatie\QueueableAction\QueueableAction;

class GetRatingOptsByModelAction
{
    use QueueableAction;

    /**
     * Undocumented function.
     */
    public function execute(HasRatingContract $model): array
    {
        return $model->ratings()
            ->wherePivot('user_id', null)
            ->pluck('title', 'ratings.id')
            ->toArray();
    }
}
