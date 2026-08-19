<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Rating\Models\Like;
use Modules\Xot\Contracts\UserContract;

/** @phpstan-ignore trait.unused */
trait HasLikes
{
    /**
     * @return Collection
     */
    public function likes()
    {
        return $this->likesRelation;
    }

    public function likedBy(?UserContract $user): void
    {
        if ($user === null) {
            return;
        }

        $this->likesRelation()->create(['user_id' => $user->id]);

        $this->unsetRelation('likesRelation');
    }

    public function dislikedBy(?UserContract $user): void
    {
        if ($user === null) {
            return;
        }

        /**
         * @var Like|null
         */
        $where = $this->likesRelation()->where('user_id', $user->id)->first();
        if ($where !== null) {
            $where->delete();
        }

        $this->unsetRelation('likesRelation');
    }

    /**
     * It's important to name the relationship the same as the method because otherwise
     * eager loading of the polymorphic relationship will fail on queued jobs.
     *
     * @see https://github.com/laravelio/laravel.io/issues/350
     */
    public function likesRelation(): MorphMany
    {
        return $this->morphMany(Like::class, 'likesRelation', 'likeable_type', 'likeable_id');
    }

    public function isLikedBy(?UserContract $user): bool
    {
        if ($user === null) {
            return false;
        }

        return $this->likesRelation()->where('user_id', $user->id)->exists();
    }

    protected static function bootHasLikes(): void
    {
        static::deleting(function (Model $model): void {
            $model->likesRelation()->delete(); /* @phpstan-ignore method.nonObject */
            $model->unsetRelation('likesRelation');
        });
    }
}
