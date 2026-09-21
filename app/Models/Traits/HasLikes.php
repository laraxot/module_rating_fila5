<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Rating\Models\Like;
use Modules\Xot\Contracts\UserContract;

<<<<<<< HEAD
trait HasLikes
{
    /**
     * @return Collection<int, Like>
     */
    public function likes(): Collection
=======
/** @phpstan-ignore trait.unused */
trait HasLikes
{
    /**
     * @return Collection
     */
    public function likes()
>>>>>>> b2d53b8 (.)
    {
        return $this->likesRelation;
    }

<<<<<<< HEAD
    public function likedBy(?UserContract $user): void
    {
        if (null === $user) {
            return;
        }

=======
    /**
     * param \Modules\Xot\Contracts\UserContract|null $user.
     *
     * @param UserContract|null $user
     */
    public function likedBy($user): void
    {
>>>>>>> b2d53b8 (.)
        $this->likesRelation()->create(['user_id' => $user->id]);

        $this->unsetRelation('likesRelation');
    }

<<<<<<< HEAD
    public function dislikedBy(?UserContract $user): void
    {
        if (null === $user) {
            return;
        }

=======
    /**
     * param \Modules\Xot\Contracts\UserContract|null $user.
     *
     * @param UserContract|null $user
     */
    public function dislikedBy($user): void
    {
        /**
         * @var Like
         */
>>>>>>> b2d53b8 (.)
        $where = $this->likesRelation()->where('user_id', $user->id)->first();
        if (null !== $where) {
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
<<<<<<< HEAD
    /** @return MorphMany<Like, $this> */
=======
>>>>>>> b2d53b8 (.)
    public function likesRelation(): MorphMany
    {
        return $this->morphMany(Like::class, 'likesRelation', 'likeable_type', 'likeable_id');
    }

<<<<<<< HEAD
    public function isLikedBy(?UserContract $user): bool
    {
        if (null === $user) {
            return false;
        }

        return $this->likesRelation()->where('user_id', $user->id)->exists();
    }

    protected static function bootHasLikes(): void
    {
        static::deleting(static function (self $model): void {
            $model->likesRelation()->delete();
=======
    /**
     * param \Modules\Xot\Contracts\UserContract|null $user.
     *
     * @param UserContract|null $user
     *
     * @return bool
     */
    public function isLikedBy($user)
    {
        return $this->likesRelation()->where('user_id', $user->id)->exists();
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    protected static function bootHasLikes()
    {
        static::deleting(function ($model): void {
            $model->likesRelation()->delete(); /* @phpstan-ignore method.nonObject */
>>>>>>> b2d53b8 (.)
            $model->unsetRelation('likesRelation');
        });
    }
}
