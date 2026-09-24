<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Fixtures;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
=======
>>>>>>> fd7a600 (.)
=======
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Rating\Models\AbstractRatingsHost;
use Modules\Rating\Models\BaseRating;
use Modules\Rating\Models\Rating;

/**
 * Host di test (richiesto da XotBaseModel::getClassName()).
 * Caricato solo dai Unit test via require_once.
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
 *
 * `ratings_by_id` arriva dall'accessor del trait ({@see AbstractRatingsHost});
 * dichiarato qui così Pest/IDE risolvono `data_get($host, 'ratings_by_id…')`
 * senza proprietà fantasma.
 *
 * @property EloquentCollection<int|string, BaseRating> $ratings_by_id
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
 */
class RatingsHostStub extends AbstractRatingsHost
{
    protected $table = 'ratings_host_stub';

    /** @var list<string> */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
    protected $fillable = [
        'title',
        'ratings_avg',
        'ratings_count',
        'post_type',
    ];
<<<<<<< HEAD
=======
    protected $fillable = ['title', 'ratings_avg', 'ratings_count', 'post_type'];
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
    protected $fillable = ['title', 'ratings_avg', 'ratings_count', 'post_type'];
>>>>>>> e8cf105 (Check & fix styling)

    /** @var MorphToMany<Rating, $this, MorphPivot, 'pivot'>|null */
    public ?MorphToMany $forcedMorph = null;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
    /**
     * Relazione forzata dai test: `ratingMorphs()` la legge come
     * `HasMany<MorphPivot, ...>`, `hasMany(Rating::class)`/`ratingObjectives()`
     * come `HasMany<Rating, ...>` (es. mock Mockery nei test).
     *
     * @var HasMany<MorphPivot, static>|HasMany<Rating, static>|null
     */
<<<<<<< HEAD
<<<<<<< HEAD
=======
    /** @var HasMany<Rating, $this>|null */
>>>>>>> fd7a600 (.)
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
    public ?HasMany $forcedHasMany = null;

    /**
     * @template TRelatedModel of Model
     *
     * @param class-string<TRelatedModel> $related
     *
     * @return MorphToMany<TRelatedModel, $this, MorphPivot, 'pivot'>
     */
    public function morphToManyX(
        string $related,
        string $name,
        ?string $_table = null,
        ?string $foreignPivotKey = null,
        ?string $relatedPivotKey = null,
        ?string $parentKey = null,
        ?string $relatedKey = null,
        ?string $relation = null,
        bool $inverse = false,
    ): MorphToMany {
        if ($this->forcedMorph instanceof MorphToMany) {
            /** @var MorphToMany<TRelatedModel, $this, MorphPivot, 'pivot'> $forcedMorph */
            $forcedMorph = $this->forcedMorph;

            return $forcedMorph;
        }

        return parent::morphToManyX(
            $related,
            $name,
            $_table,
            $foreignPivotKey,
            $relatedPivotKey,
            $parentKey,
            $relatedKey,
            $relation,
            $inverse,
        );
    }

    /**
     * Bypassa `Rating::getClassName()` (risoluzione via `debug_backtrace`, verificata
     * fragile/ambientale su questa macchina — vedi nota nel test) quando il test forza
     * esplicitamente la relazione, stesso pattern di `morphToManyX()` sopra.
     *
     * @return MorphToMany<BaseRating, static, MorphPivot, 'pivot'>
     */
    public function ratings(): MorphToMany
    {
        if ($this->forcedMorph instanceof MorphToMany) {
            /** @var MorphToMany<BaseRating, static, MorphPivot, 'pivot'> $forcedMorph */
            $forcedMorph = $this->forcedMorph;

            return $forcedMorph;
        }

        return parent::ratings();
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/dev
=======
>>>>>>> e8cf105 (Check & fix styling)
     * Evita Rating::getClassName()/guessMorphPivot nei unit (backtrace fragile).
     *
     * @return HasMany<MorphPivot, static>
     */
    public function ratingMorphs(): HasMany
    {
        if ($this->forcedHasMany instanceof HasMany) {
            /** @var HasMany<MorphPivot, static> $forcedHasMany */
            $forcedHasMany = $this->forcedHasMany;

            return $forcedHasMany;
        }

        return parent::ratingMorphs();
    }

    /**
<<<<<<< HEAD
=======
>>>>>>> fd7a600 (.)
=======
>>>>>>> e8cf105 (Check & fix styling)
     * @template TRelatedModel of Model
     *
     * @param class-string<TRelatedModel> $related
     *
     * @return HasMany<TRelatedModel, $this>
     */
    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        if ($this->forcedHasMany instanceof HasMany) {
            /** @var HasMany<TRelatedModel, $this> $forcedHasMany */
            $forcedHasMany = $this->forcedHasMany;

            return $forcedHasMany;
        }

        return parent::hasMany($related, $foreignKey, $localKey);
    }
}
