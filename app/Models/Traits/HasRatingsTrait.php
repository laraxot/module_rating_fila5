<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
<<<<<<< HEAD
use Illuminate\Database\Query\JoinClause;
=======
>>>>>>> laraxot/dev
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Rating\Models\BaseRating;
use Modules\Rating\Models\Rating;
<<<<<<< HEAD
use Webmozart\Assert\Assert;
=======
>>>>>>> laraxot/dev

/**
 * Trait HasRatingsTrait.
 *
 * @see Modules/Rating/docs/schemaless-attributes.md
 */
/** @phpstan-ignore trait.unused (Trade-off: usato da moduli esterni; PHPStan sul solo modulo Rating non vede i consumer.) */
trait HasRatingsTrait
{
    /**
     * @return class-string<BaseRating>
     */
    public function getRatingClass(): string
    {
<<<<<<< HEAD
        $ratingClass = (string) Str::of($this::class)
=======
        $ratingClass = (string) Str::of(static::class)
>>>>>>> laraxot/dev
            ->before('\Models\\')
            ->append('\Models\Rating');

        if (is_a($ratingClass, BaseRating::class, true)) {
            return $ratingClass;
        }

        return Rating::class;
    }

    /**
     * Get ratings for this model.
     *
<<<<<<< HEAD
     * @return MorphToMany<Rating, static, \Illuminate\Database\Eloquent\Relations\MorphPivot, 'pivot'>
     */
    /** @phpstan-ignore missingType.generics (Trade-off: generics completi in PHPDoc, ma larastan non li risolve quando il trait è verificato "in context of" una classe di un altro modulo — riproducibile SOLO in scan multi-modulo, mai in scan scoped; vedi getRatingClass() che ha lo stesso sintomo con un @return banale senza static/$this.) */
    public function ratings(): MorphToMany
    {
        /** @var MorphToMany<Rating, static, \Illuminate\Database\Eloquent\Relations\MorphPivot, 'pivot'> $result */
=======
     * @return MorphToMany<Rating, static>
     */
    public function ratings(): MorphToMany
    {
        /** @var MorphToMany<Rating, static> $result */
>>>>>>> laraxot/dev
        $result = $this->morphToMany(Rating::class, 'model', 'ratings', 'rating_morph');

        return $result;
    }

    /**
     * Get rating objectives with aggregated data.
     *
     * @return HasMany<BaseRating, static>
     */
<<<<<<< HEAD
    /** @phpstan-ignore missingType.generics (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
=======
>>>>>>> laraxot/dev
    public function ratingObjectives(): HasMany
    {
        $relatedClass = $this->getRatingClass();
        $userId = (int) Auth::id();

        /** @var HasMany<BaseRating, static> $result */
<<<<<<< HEAD
        /** @phpstan-ignore argument.type, argument.templateType (Trade-off: getRatingClass() dichiara @return class-string<BaseRating>, ma il docblock non è risolto in context cross-modulo — vedi ratings().) */
=======
>>>>>>> laraxot/dev
        $result = $this->hasMany($relatedClass, 'related_type', 'post_type')
            ->selectRaw(
                'ratings.*,
                count(value) as rating_count,
                avg(value) as rating_avg,
                sum(if(user_id = ?, value, 0)) AS rating_my',
                [$userId]
            )->leftJoin(
                'rating_morph',
<<<<<<< HEAD
                function (JoinClause $join): void {
=======
                function (\Illuminate\Database\Query\JoinClause $join): void {
>>>>>>> laraxot/dev
                    $join->on('rating_morph.rating_id', 'ratings.id')
                        ->whereColumn('rating_morph.post_type', 'ratings.related_type')
                        ->where('rating_morph.post_id', $this->id);
                }
            )->groupBy('ratings.id')
            ->with('post');

        return $result;
    }

    /**
     * Scope a query to only include popular users.
     *
<<<<<<< HEAD
     * @param  Builder<static>  $query
     *
     * @return Builder<static>
     */
    /** @phpstan-ignore missingType.generics, missingType.generics (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan; il tag ripetuto sopprime sia il parametro $query sia il return type.) */
=======
     * @param Builder<static> $query
     *
     * @return Builder<static>
     */
>>>>>>> laraxot/dev
    public function scopeWithRating(Builder $query): Builder
    {
        return $query->leftJoin(
            'rating_morph',
<<<<<<< HEAD
            function (JoinClause $join): void {
=======
            function (\Illuminate\Database\Query\JoinClause $join): void {
>>>>>>> laraxot/dev
                $join->on('rating_morph.post_type', '=', 'ratings.related_type');
            }
        );
    }

    /**
     * Get my ratings for this model.
     *
     * @return MorphToMany<Rating, static>
     */
<<<<<<< HEAD
    /** @phpstan-ignore missingType.generics (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
=======
>>>>>>> laraxot/dev
    public function myRatings(): MorphToMany
    {
        /** @var MorphToMany<Rating, static> $result */
        $result = $this->morphToMany(Rating::class, 'model', 'ratings', 'rating_morph')
            ->wherePivot('user_id', (string) Auth::id());

        return $result;
    }

    // ----- mutators -----
    /**
     * @return Collection<int|string, mixed>
     */
<<<<<<< HEAD
    /** @phpstan-ignore missingType.generics (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
=======
>>>>>>> laraxot/dev
    public function getMyRatingAttribute(): Collection
    {
        $myRatings = $this->myRatings;

        return $myRatings->pluck('pivot.rating', 'post_id');
    }

    /**
     * ----.
     */
    public function getRatingsAvgAttribute(?float $value): ?float
    {
<<<<<<< HEAD
        if ($value !== null) {
            return $value;
        }
        $value = $this->ratings->avg('pivot.rating');
        if ($value !== null) {
            // ✅ Persist con update chirurgico (salva SOLO questo campo, previene loop)
            if ($this->getKey() !== null) {
=======
        if (null !== $value) {
            return $value;
        }
        $value = $this->ratings->avg('pivot.rating');
        if (null !== $value) {
            // ✅ Persist con update chirurgico (salva SOLO questo campo, previene loop)
            if (null !== $this->getKey()) {
>>>>>>> laraxot/dev
                $this->update(['ratings_avg' => $value]);
            }
        }

        return $value;
    }

    public function getRatingsCountAttribute(?int $value): ?int
    {
<<<<<<< HEAD
        if ($value !== null) {
=======
        if (null !== $value) {
>>>>>>> laraxot/dev
            return $value;
        }
        $value = $this->ratings->count();
        $this->ratings_count = $value;

        // Guard: modello deve avere PK per salvare
<<<<<<< HEAD
        if ($this->getKey() === null) {
=======
        if (null == $this->getKey()) {
>>>>>>> laraxot/dev
            return $value;
        }

        // ✅ Persist con update chirurgico (salva SOLO questo campo, previene loop)
        $this->update(['ratings_count' => $value]);

        return $value;
    }

    /**
     * Get ratings filtered by extra_attributes.
     *
<<<<<<< HEAD
     * @param  array<string, mixed>  $filters
     *
     * @return Collection<int, Rating>
     */
    /** @phpstan-ignore missingType.iterableValue, missingType.generics (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
=======
     * @param array<string, mixed> $filters
     *
     * @return Collection<int, Rating>
     */
>>>>>>> laraxot/dev
    public function getRatingsWhere(array $filters): Collection
    {
        $query = $this->ratings();

        foreach ($filters as $key => $filterValue) {
            $query->where("extra_attributes->{$key}", $filterValue);
        }

        /** @var Collection<int, Rating> $result */
        $result = $query->get();

        return $result;
    }

    /**
<<<<<<< HEAD
     * @param  array<string, mixed>  $where
     *
     * @return Collection<int, mixed>
     */
    /** @phpstan-ignore missingType.iterableValue, missingType.generics (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
    public function syncRatingsWhere(array $where): Collection
    {
        $ratingClass = $this->getRatingClass();
        $ratingQuery = $ratingClass::query();
        /** @phpstan-ignore method.nonObject (Trade-off: getRatingClass() dichiara @return class-string<BaseRating>, non risolto in context cross-modulo — vedi ratings().) */
        /** @phpstan-ignore argument.type (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
        $ratingQuery = $ratingQuery->withExtraAttributes($where);
        /** @phpstan-ignore method.nonObject (Trade-off: getRatingClass() dichiara @return class-string<BaseRating>, non risolto in context cross-modulo — vedi ratings().) */
        $ratings = $ratingQuery->get();

        /** @phpstan-ignore method.nonObject (Trade-off: getRatingClass() dichiara @return class-string<BaseRating>, non risolto in context cross-modulo — vedi ratings().) */
        $ratingIds = $ratings->modelKeys();
        /** @phpstan-ignore argument.type (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
        $this->ratings()->sync($ratingIds);
=======
     * @param array<string, mixed> $where
     *
     * @return Collection<int, mixed>
     */
    public function syncRatingsWhere(array $where): Collection
    {
        $ratingClass = $this->getRatingClass();
        $ratings = $ratingClass::query()
            ->withExtraAttributes($where)
            ->get();

        $rating_ids = $ratings->modelKeys();
        $this->ratings()->sync($rating_ids);
>>>>>>> laraxot/dev

        /** @var Collection<int, mixed> $result */
        $result = $this->ratings;

        return $result;
    }

    // */
    /*
        public function setMyRatingAttribute($value){
        dddx($value);
        }
    */
    // ------ functions ------
    /**
     * @throws FileNotFoundException
     * @throws \ReflectionException
     */
    public function ratingAvgHtml(): string
    {
<<<<<<< HEAD
        $pivotAvg = $this->ratings_avg;
        $pivotCount = $this->ratings_count;

        $msg = '<div class="rateit" data-rateit-value="'.$pivotAvg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivotAvg.') '.$pivotCount.' Votes ';

        $ratingUrl = '#';
        $title = 'Vota '.(isset($this->title) ? (string) $this->title : '');

        $btn = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$ratingUrl.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        $btnIframe = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$ratingUrl.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn.$btnIframe;
=======
        $pivot_avg = $this->ratings_avg;
        $pivot_cout = $this->ratings_count;

        $msg = '<div class="rateit" data-rateit-value="'.$pivot_avg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivot_avg.') '.$pivot_cout.' Votes ';

        $rating_url = '#';
        $title = 'Vota '.(isset($this->title) ? (string) $this->title : '');

        $btn = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        $btn_iframe = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn.$btn_iframe;
>>>>>>> laraxot/dev
    }

    /**
     * @return array<string, string>
     */
<<<<<<< HEAD
    /** @phpstan-ignore missingType.iterableValue (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
=======
>>>>>>> laraxot/dev
    public function getRatingsRules(string $prefix, string $postfix): array
    {
        $rows = $this->ratings;
        $rules = $rows->mapWithKeys(function ($row) {
            $ruleValue = $row->rule instanceof \BackedEnum ? (string) $row->rule->value : (string) $row->rule;

            return [$row->id => $ruleValue];
        })->toArray();

        $rules = Arr::prependKeysWith($rules, $prefix);
        $res = [];
        foreach ($rules as $key => $ruleValue) {
            $keyWithPostfix = $key.$postfix;
<<<<<<< HEAD
            Assert::string($ruleValue);
            $ruleStr = $ruleValue;
=======
            $ruleStr = (string) $ruleValue;
>>>>>>> laraxot/dev

            // ✅ Se la regola è numeric o integer, aggiungi nullable se non presente
            if (Str::contains($ruleStr, ['numeric', 'integer']) && ! Str::contains($ruleStr, 'nullable')) {
                $ruleStr = 'nullable|'.$ruleStr;
            }

            $res[$keyWithPostfix] = $ruleStr;
        }

        return $res;
    }

    /**
     * @return array<string, string>
     */
<<<<<<< HEAD
    /** @phpstan-ignore missingType.iterableValue (Trade-off: vedi nota su ratings() — stesso limite cross-modulo di larastan.) */
=======
>>>>>>> laraxot/dev
    public function getRatingsValidationAttributes(string $prefix, string $postfix): array
    {
        $rows = $this->ratings;
        $res = [];
        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$row->id.$postfix;
            $res[$keyWithPostfix] = (string) $row->title;
        }

        return $res;
    }
}
