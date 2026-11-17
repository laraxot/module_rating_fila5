<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Modules\Rating\Database\Factories\RatingFactory;
use Modules\Rating\Enums\RuleEnum;
use Modules\Xot\Contracts\ProfileContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Modules\Rating\Models\BaseRating.
 *
 * Classe base astratta per tutti i modelli Rating nei vari moduli.
 * Fornisce casts, fillable, scope e media conversions condivisi (DRY).
 *
 * @see https://github.com/spatie/laravel-schemaless-attributes
 * @see /Modules/Rating/docs/schemaless-attributes-errors.md
 *
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes $extra_attributes
 * @property RuleEnum                                          $rule
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
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
 * @property MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                          $media_count
 * @property ProfileContract|null                              $creator
 * @property ProfileContract|null                              $updater
 *
 * @mixin Eloquent
 *
 * @method static RatingFactory factory($count = null, $state = [])
 */
abstract class BaseRating extends BaseModel implements HasMedia
{
    use HasSlug;
    use InteractsWithMedia;

    /** @var list<string> */
    protected $fillable = [
        'id',
        'extra_attributes',
        'title',
        'color',
        'txt',
        'rule',
        'is_disabled',
        'is_readonly',
        'order_column',
        'slug',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Scope to query by extra attributes.
     *
     * @see https://github.com/spatie/laravel-schemaless-attributes
     * @see /Modules/Rating/docs/schemaless-attributes-errors.md
     *
     * @param Builder<BaseRating>         $query
     * @param array<string, mixed>|string $attributes
     *
     * @return Builder<BaseRating>
     */
    public function scopeWithExtraAttributes(Builder $query, array|string $attributes = [], mixed $value = null): Builder
    {
        if (is_string($attributes) && null !== $value) {
            // Single attribute with value: withExtraAttributes('anno', 2024)
            return $query->where("extra_attributes->{$attributes}", $value);
        }

        if (is_array($attributes)) {
            // Multiple attributes: withExtraAttributes(['anno' => 2024, 'type' => 'foo'])
            foreach ($attributes as $key => $val) {
                $query = $query->where("extra_attributes->{$key}", $val);
            }
        }

        return $query;
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function linkedTo(): MorphTo
    {
        return $this->morphTo('model');
    }

    /**
     * Register the conversions that should be performed.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('300x300')
            ->width(300)
            ->height(300);
        $this->addMediaConversion('150x150')
            ->width(151)
            ->height(151);
        $this->addMediaConversion('50x50')
            ->width(150)
            ->height(150);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @see https://github.com/spatie/laravel-schemaless-attributes
     * @see /Modules/Rating/docs/schemaless-attributes-errors.md
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'extra_attributes' => SchemalessAttributes::class,
            'rule' => RuleEnum::class,
            'is_disabled' => 'boolean',
            'is_readonly' => 'boolean',
        ];
    }
}
