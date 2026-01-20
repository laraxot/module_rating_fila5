<?php

declare(strict_types=1);

namespace Modules\Rating\Contracts;

use Modules\Xot\Contracts\UserContract;

/**
 * This interface allows models to receive replies.
 */
interface HasLikeContract
{
    /**
     * @param UserContract|null $user
     *
     * @return bool
     */
    public function isLikedBy($user);

    /**
     * @param UserContract|null $user
     *
     * @return void
     */
    public function likedBy($user);

    /**
     * @param UserContract|null $user
     *
     * @return void
     */
    public function dislikedBy($user);
}
