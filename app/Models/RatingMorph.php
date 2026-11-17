<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;

/**
 * Modules\Rating\Models\RatingMorph.
 *
 * @property int         $id
 * @property bool        $is_winner
 * @property string|null $post_type
 * @property int|null    $post_id
 * @property string|null $related_type
 * @property int|null    $related_id
 * @property Rating|null $rating
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null    $auth_user_id
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static RatingMorph create(array<string, mixed> $attributes = [])
 * @method static Builder<static> where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder<static> whereAuthUserId($value)
 * @method static Builder<static> whereCreatedAt($value)
 * @method static Builder<static> whereCreatedBy($value)
 * @method static Builder<static> whereDeletedBy($value)
 * @method static Builder<static> whereId($value)
 * @method static Builder<static> wherePostId($value)
 * @method static Builder<static> wherePostType($value)
 * @method static Builder<static> whereRating($value)
 * @method static Builder<static> whereRelatedId($value)
 * @method static Builder<static> whereRelatedType($value)
 * @method static Builder<static> whereUpdatedAt($value)
 * @method static Builder<static> whereUpdatedBy($value)
 *
 * @property string|null $user_id
 * @property string|null $model_type
 * @property int|null    $model_id
 * @property int         $rating_id
 * @property int|null    $value
 * @property string|null $note
 * @property string|null $deleted_at
 *
 * @method static Builder<static> whereDeletedAt($value)
 * @method static Builder<static> whereIsWinner($value)
 * @method static Builder<static> whereModelId($value)
 * @method static Builder<static> whereModelType($value)
 * @method static Builder<static> whereNote($value)
 * @method static Builder<static> whereRatingId($value)
 * @method static Builder<static> whereUserId($value)
 * @method static Builder<static> whereValue($value)
 *
 * @property Model|\Eloquent   $model
 * @property Model|null        $profile
 * @property UserContract|null $user
 * @property string            $reward
 *
 * @method static Builder<static> whereReward($value)
 *
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @property string               $sum_credit_yes
 * @property string               $sum_credit_no
 * @property int                  $count_credit_yes
 * @property int                  $count_credit_no
 * @property string               $percentage
 *
 * @method static Builder<static>|RatingMorph whereCountCreditNo($value)
 * @method static Builder<static>|RatingMorph whereCountCreditYes($value)
 * @method static Builder<static>|RatingMorph whereHasYesNo($value)
 * @method static Builder<static>|RatingMorph wherePercentage($value)
 * @method static Builder<static>|RatingMorph whereSumCreditNo($value)
 * @method static Builder<static>|RatingMorph whereSumCreditYes($value)
 *
 * @property ProfileContract|null $deleter
 *
 * @mixin Eloquent
 */
class RatingMorph extends BaseMorphPivot
{
    /** @var list<string> */
    protected $fillable = [
        'id',
        'model_id', 'model_type',
        'rating_id',
        'user_id',
        'note',
        'value',
        'is_winner',
        'reward',
    ];
    // -------- RELATIONSHIP -----------

    /**
     * @return BelongsTo<Rating, $this>
     */
    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class, 'rating_id');
    }

    /**
     * @return BelongsTo<\Illuminate\Database\Eloquent\Model&UserContract, $this>
     */
    public function user(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class, 'user_id');
    }

    /**
     * @return BelongsTo<\Illuminate\Database\Eloquent\Model&ProfileContract, $this>
     */
    public function profile(): BelongsTo
    {
        $profile_class = XotData::make()->getProfileClass();

        return $this->belongsTo($profile_class, 'user_id', 'user_id');
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
