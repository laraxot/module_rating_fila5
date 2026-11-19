<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Media\Models\Media;
use Modules\Rating\Database\Factories\RatingFactory;
use Modules\Rating\Enums\RuleEnum;
use Modules\Xot\Contracts\ProfileContract;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\SchemalessAttributes\SchemalessAttributes;

/**
 * Modules\Rating\Models\Rating.
 *
 * Estende BaseRating per ereditare casts, fillable, scope e media conversions (DRY).
 *
 * @see BaseRating
 * @see https://github.com/spatie/laravel-schemaless-attributes
 * @see /Modules/Rating/docs/schemaless-attributes-errors.md
 *
 * @property SchemalessAttributes $extra_attributes
 * @property RuleEnum             $rule
 * @property RuleEnum             $rule
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static Rating create(array<string, mixed> $attributes = [])
 * @method static Builder<static> where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder<static> withExtraAttributes(array<string, mixed>|string $attributes = [], mixed $value = null)
 *
 * @property int             $id
 * @property int             $user_id
 * @property float           $value
 * @property string|null     $related_type
 * @property string|null     $created_by
 * @property string|null     $updated_by
 * @property string|null     $deleted_by
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 * @property int|null        $post_id
 * @property string|null     $title
 * @property string|null     $color
 * @property string|null     $icon
 * @property string|null     $txt
 * @property bool|null       $is_disabled
 * @property bool|null       $is_readonly
 * @property int|null        $order_column
 * @property Model|\Eloquent $linkedTo
 * @property int             $id
 * @property int             $user_id
 * @property float           $value
 * @property string|null     $related_type
 * @property string|null     $created_by
 * @property string|null     $updated_by
 * @property string|null     $deleted_by
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 * @property int|null        $post_id
 * @property string|null     $title
 * @property string|null     $color
 * @property string|null     $icon
 * @property string|null     $txt
 * @property bool|null       $is_disabled
 * @property bool|null       $is_readonly
 * @property int|null        $order_column
 * @property Model|\Eloquent $linkedTo
 *
 * @method static Builder<static> whereColor($value)
 * @method static Builder<static> whereCreatedAt($value)
 * @method static Builder<static> whereCreatedBy($value)
 * @method static Builder<static> whereDeletedBy($value)
 * @method static Builder<static> whereIcon($value)
 * @method static Builder<static> whereId($value)
 * @method static Builder<static> whereIsDisabled($value)
 * @method static Builder<static> whereIsReadonly($value)
 * @method static Builder<static> whereOrderColumn($value)
 * @method static Builder<static> wherePostId($value)
 * @method static Builder<static> whereRelatedType($value)
 * @method static Builder<static> whereRule($value)
 * @method static Builder<static> whereTitle($value)
 * @method static Builder<static> whereTxt($value)
 * @method static Builder<static> whereUpdatedAt($value)
 * @method static Builder<static> whereUpdatedBy($value)
 *
 * @property MediaCollection<int, Media> $media
 * @property int|null                    $media_count
 * @property ProfileContract|null        $creator
 * @property ProfileContract|null        $updater
 * @property int|null                    $media_count
 * @property ProfileContract|null        $creator
 * @property ProfileContract|null        $updater
 *
 * @method static RatingFactory factory($count = null, $state = [])
 *
 * @property ProfileContract|null $deleter
 *
 * @mixin Eloquent
 */
class Rating extends BaseRating
{
    // DRY: casts(), $fillable, scopeWithExtraAttributes(), linkedTo(), registerMediaConversions()
    // sono tutti ereditati da BaseRating.
    // @see Modules/Rating/docs/schemaless-attributes-errors.md
}
