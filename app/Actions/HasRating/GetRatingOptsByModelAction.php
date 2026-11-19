<?php

declare(strict_types=1);

namespace Modules\Rating\Actions\HasRating;

use Modules\Rating\Models\Contracts\HasRatingContract;
use Spatie\QueueableAction\QueueableAction;

class GetRatingOptsByModelAction
{
    use QueueableAction;

    /**
     * Options id=>title for ratings linked to the host without a betting user.
     *
     * @return array<int|string, string>
     */
    public function execute(HasRatingContract $model): array
    {
        $options = [];
        foreach ($model->ratings()->wherePivot('user_id', null)->get() as $rating) {
            if (is_string($rating->title) && '' !== $rating->title) {
                $options[$rating->id] = $rating->title;
            }
        }

        return $options;
    }
}
