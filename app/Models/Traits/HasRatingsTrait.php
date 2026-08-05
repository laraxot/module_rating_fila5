<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Rating\Models\BaseRating;
use Modules\Rating\Models\Rating;
use Modules\Xot\Actions\Cast\SafeStringCastAction;

/**
 * Trait HasRatingsTrait.
 *
 * @see Modules/Rating/docs/schemaless-attributes.md
 *
 * @phpstan-ignore trait.unused (Trade-off: usato da moduli esterni; PHPStan sul solo modulo Rating non vede i consumer.)
 */
trait HasRatingsTrait
{
/**
      * @return class-string<BaseRating>
      */
     public function getRatingClass(): class-string<BaseRating>
    {
        $ratingClass = (string) Str::of(static::class)
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
     * @return MorphToMany<Rating, $this>
     */
     public function ratings(): MorphToMany<Rating, $this>
    {
        /** @var MorphToMany<Rating, $this> $result */
        $result = $this->morphToMany(Rating::class, 'model', 'ratings', 'rating_morph');

        return $result;
    }

/**
     * Get rating objectives with aggregated data.
     *
     * @return HasMany<BaseRating, $this>
     */
     public function ratingObjectives(): HasMany<BaseRating, $this>
    {
        $relatedClass = $this->getRatingClass();
        $userId = (int) Auth::id();

        assert(is_a($relatedClass, BaseRating::class, true));
        /** @var class-string<Model> $relatedClass */
        $relatedClass = $this->getRatingClass();

        /** @var HasMany<BaseRating, $this> $result */
        $result = $this->hasMany($relatedClass, 'related_type', 'post_type')
             ->selectRaw(
                 'ratings.*,
                 count(value) as rating_count,
                 avg(value) as rating_avg,
                 sum(if(user_id = ?, value, 0)) AS rating_my',
                 [$userId]
             )->leftJoin(
                 'rating_morph',
                 function (JoinClause $join): void {
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
     * @param Builder<static> $query
     *
     * @return Builder<static>
     */
    public function scopeWithRating(Builder $query): Builder
    {
        return $query->leftJoin(
            'rating_morph',
            function (JoinClause $join): void {
                $join->on('rating_morph.post_type', '=', 'ratings.related_type');
            }
        );
    }

    /**
     * Get my ratings for this model.
     *
     * @return MorphToMany<Rating, $this>
     */
    public function myRatings(): MorphToMany
    {
        $userId = Auth::id();
        /** @var MorphToMany<Rating, $this> $result */
        $result = $this->morphToMany(Rating::class, 'model', 'ratings', 'rating_morph')
            ->wherePivot('user_id', $userId);

        return $result;
    }

    // ----- mutators -----
/**
     * @return Collection<int|string, Rating>
     */
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
        if (null !== $value) {
            return $value;
        }
        $value = $this->ratings->avg('pivot.rating');
        if (null !== $value) {
            // ✅ Persist con update chirurgico (salva SOLO questo campo, previene loop)
            if (null !== $this->getKey()) {
                $this->update(['ratings_avg' => $value]);
            }
        }

        return $value;
    }

    public function getRatingsCountAttribute(?int $value): ?int
    {
        if (null !== $value) {
            return $value;
        }
        $value = $this->ratings->count();
        $this->ratings_count = $value;

        // Guard: modello deve avere PK per salvare
        if (null == $this->getKey()) {
            return $value;
        }

        // ✅ Persist con update chirurgico (salva SOLO questo campo, previene loop)
        $this->update(['ratings_count' => $value]);

        return $value;
    }

    /**
     * Get ratings filtered by extra_attributes.
     *
     * @param array<string, mixed> $filters
     *
     * @return Collection<int, Rating>
     */
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

        $ratingIds = $ratings->modelKeys();
        $this->ratings()->sync($ratingIds);

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
        $safeStringCastAction = app(SafeStringCastAction::class);
        $pivotAvg = $safeStringCastAction->execute($this->ratings_avg);
        $pivotCount = $safeStringCastAction->execute($this->ratings_count);
        $title = 'Vota '.$safeStringCastAction->execute($this->title ?? '');

        $msg = '<div class="rateit" data-rateit-value="'.$pivotAvg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivotAvg.') '.$pivotCount.' Votes ';

        $ratingUrl = '#';

        $btn = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$ratingUrl.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        $btnIframe = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$ratingUrl.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn.$btnIframe;
    }

    /**
     * @return array<string, string>
     */
    public function getRatingsRules(string $prefix, string $postfix): array
    {
        $safeStringCastAction = app(SafeStringCastAction::class);
        $rows = $this->ratings;
        $res = [];
        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$safeStringCastAction->execute($row->id).$postfix;
            $ruleStr = $this->ratingRuleToString($row->rule, $safeStringCastAction);

            // ✅ Se la regola è numeric o integer, aggiungi nullable se non presente
            if (Str::contains($ruleStr, ['numeric', 'integer']) && ! Str::contains($ruleStr, 'nullable')) {
                $ruleStr = 'nullable|'.$ruleStr;
            }

            $res[$keyWithPostfix] = $ruleStr;
        }

        return $res;
    }

    private function ratingRuleToString(mixed $rule, SafeStringCastAction $safeStringCastAction): string
    {
        if ($rule instanceof \BackedEnum) {
            return $safeStringCastAction->execute($rule->value);
        }

        return $safeStringCastAction->execute($rule);
    }

    /**
     * @return array<string, string>
     */
    public function getRatingsValidationAttributes(string $prefix, string $postfix): array
    {
        $safeStringCastAction = app(SafeStringCastAction::class);
        $rows = $this->ratings;
        $res = [];
        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$safeStringCastAction->execute($row->id).$postfix;
            /** @var string|null $title */
            $title = $row->title;
            $res[$keyWithPostfix] = $safeStringCastAction->execute($title);
        }

        return $res;
    }
}
