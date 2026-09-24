<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Rating\Models\Like;
use Modules\Xot\Contracts\UserContract;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
trait HasLikes
{
    /**
     * @return Collection<int, Like>
     */
    public function likes(): Collection
=======
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
/** @phpstan-ignore trait.unused */
trait HasLikes
{
    /**
     * @return Collection
     */
    public function likes()
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
    {
        return $this->likesRelation;
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function likedBy(?UserContract $user): void
    {
        if (null === $user) {
            return;
        }

=======
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
    /**
     * param \Modules\Xot\Contracts\UserContract|null $user.
     *
     * @param UserContract|null $user
     */
    public function likedBy($user): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
        $this->likesRelation()->create(['user_id' => $user->id]);

        $this->unsetRelation('likesRelation');
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function dislikedBy(?UserContract $user): void
    {
        if (null === $user) {
            return;
        }

=======
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
    /** @return MorphMany<Like, $this> */
=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
    public function likesRelation(): MorphMany
    {
        return $this->morphMany(Like::class, 'likesRelation', 'likeable_type', 'likeable_id');
    }

<<<<<<< HEAD
<<<<<<< HEAD
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
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
            $model->unsetRelation('likesRelation');
        });
    }
}
