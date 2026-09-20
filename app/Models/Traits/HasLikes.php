<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Database\Eloquent\Collection;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
=======
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Rating\Models\Like;
use Modules\Xot\Contracts\UserContract;

<<<<<<< HEAD
/**
 * @phpstan-require-extends Model
 */
=======
>>>>>>> laraxot/dev
trait HasLikes
{
    /**
     * @return Collection<int, Like>
     */
    public function likes(): Collection
    {
        return $this->likesRelation;
    }

    public function likedBy(?UserContract $user): void
    {
<<<<<<< HEAD
        if ($user === null) {
=======
        if (null === $user) {
>>>>>>> laraxot/dev
            return;
        }

        $this->likesRelation()->create(['user_id' => $user->id]);

        $this->unsetRelation('likesRelation');
    }

    public function dislikedBy(?UserContract $user): void
    {
<<<<<<< HEAD
        if ($user === null) {
=======
        if (null === $user) {
>>>>>>> laraxot/dev
            return;
        }

        $where = $this->likesRelation()->where('user_id', $user->id)->first();
<<<<<<< HEAD
        if ($where !== null) {
=======
        if (null !== $where) {
>>>>>>> laraxot/dev
            $where->delete();
        }

        $this->unsetRelation('likesRelation');
    }

    /**
     * It's important to name the relationship the same as the method because otherwise
     * eager loading of the polymorphic relationship will fail on queued jobs.
     *
     * @see https://github.com/laravelio/laravel.io/issues/350
<<<<<<< HEAD
     *
     * @return MorphMany<Like, $this>
     */
=======
     */
    /** @return MorphMany<Like, $this> */
>>>>>>> laraxot/dev
    public function likesRelation(): MorphMany
    {
        return $this->morphMany(Like::class, 'likesRelation', 'likeable_type', 'likeable_id');
    }

    public function isLikedBy(?UserContract $user): bool
    {
<<<<<<< HEAD
        if ($user === null) {
=======
        if (null === $user) {
>>>>>>> laraxot/dev
            return false;
        }

        return $this->likesRelation()->where('user_id', $user->id)->exists();
    }

    protected static function bootHasLikes(): void
    {
<<<<<<< HEAD
        static::deleting(static function (Model $model): void {
            if (! $model instanceof self) {
                return;
            }

=======
        static::deleting(static function (self $model): void {
>>>>>>> laraxot/dev
            $model->likesRelation()->delete();
            $model->unsetRelation('likesRelation');
        });
    }
}
