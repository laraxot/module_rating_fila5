<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Rating\Models\BaseRating;
use Modules\Rating\Models\Rating;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Webmozart\Assert\Assert;

/**
 * Trait HasRatingsTrait — rating polimorfi su modelli host.
 *
 * Perché: un solo punto per relazioni, sync per extra_attributes, regole validazione.
 * Consumer: `@use HasRatingsTrait<static>` sulla classe host.
 *
 * @template TModel of Model
 *
 * @phpstan-require-extends Model
 */
trait HasRatingsTrait
{
    /**
     * @return MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'>
     */
    public function ratings(): MorphToMany
    {
        /** @var class-string<BaseRating> $related */
        $related = Rating::getClassName();
        Assert::subclassOf($related, BaseRating::class);

        /** @var MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'> $relation */
        $relation = $this->morphToManyX($related, 'model');

        return $relation;
    }

    /**
     * Obiettivi rating con aggregati (count, avg, voto utente corrente).
     *
     * @return HasMany<BaseRating, TModel>
     */
    public function ratingObjectives(): HasMany
    {
        $userId = Auth::id();

        /** @var class-string<BaseRating> $related */
        $related = Rating::getClassName();
        Assert::subclassOf($related, BaseRating::class);

        /** @var HasMany<BaseRating, TModel> $query */
        $query = $this->hasMany($related, 'related_type', 'post_type')
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
                        ->where('rating_morph.post_id', $this->getKey());
                }
            )->groupBy('ratings.id')
            ->with('post');

        return $query;
    }

    /**
     * @param  Builder<TModel>  $query
     * @return Builder<TModel>
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
     * @return MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'>
     */
    public function myRatings(): MorphToMany
    {
        $userId = Auth::id();

        /** @var class-string<BaseRating> $related */
        $related = Rating::getClassName();
        Assert::subclassOf($related, BaseRating::class);

        /** @var MorphToMany<BaseRating, TModel, MorphPivot, 'pivot'> $query */
        $query = $this->morphToManyX($related, 'model')
            ->wherePivot('user_id', $userId);

        return $query;
    }

    /**
     * @return Collection<string|int, mixed>
     */
    public function getMyRatingAttribute(): Collection
    {
        /** @var Collection<int, BaseRating> $myRatings */
        $myRatings = $this->myRatings;

        return $myRatings->pluck('pivot.rating', 'post_id');
    }

    public function getRatingsAvgAttribute(?float $value): ?float
    {
        return (float) ($value ?? 0);
    }

    public function getRatingsCountAttribute(?int $value): ?int
    {
        return $value ?? 0;
    }

    /**
     * @param  array<string, mixed>  $filters
     * @return Collection<int, BaseRating>
     */
    public function getRatingsWhere(array $filters): Collection
    {
        $query = $this->ratings();

        foreach ($filters as $key => $filterValue) {
            $query->where("extra_attributes->{$key}", $filterValue);
        }

        /** @var Collection<int, BaseRating> $result */
        $result = $query->get();

        return $result;
    }

    /**
     * Sync pivot verso rating che matchano extra_attributes.
     *
     * @param  array<string, mixed>  $where
     * @return Collection<int, BaseRating>
     */
    public function syncRatingsWhere(array $where): Collection
    {
        /** @var class-string<BaseRating> $ratingClass */
        $ratingClass = Rating::getClassName();
        Assert::subclassOf($ratingClass, BaseRating::class);

        $ratings = $ratingClass::withExtraAttributes($where)->get();

        /** @var list<int|string> $ratingIds */
        $ratingIds = $ratings->pluck('id')->all();

        if ($ratingIds !== []) {
            $this->ratings()->sync($ratingIds);
        }

        /** @var Collection<int, BaseRating> $result */
        $result = $this->ratings;

        return $result;
    }

    /**
     * @throws FileNotFoundException
     * @throws \ReflectionException
     */
    public function ratingAvgHtml(): string
    {
        $safeStringCastAction = app(SafeStringCastAction::class);
        $pivotAvg = $safeStringCastAction->execute($this->ratings_avg ?? 0);
        $pivotCount = $safeStringCastAction->execute($this->ratings_count ?? 0);
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
        /** @var Collection<int, BaseRating> $rows */
        $rows = $this->ratings;
        $res = [];

        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$safeStringCastAction->execute($row->id).$postfix;
            $ruleStr = $this->ratingRuleToString($row->rule, $safeStringCastAction);

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
        /** @var Collection<int, BaseRating> $rows */
        $rows = $this->ratings;
        $res = [];

        foreach ($rows as $row) {
            $keyWithPostfix = $prefix.$safeStringCastAction->execute($row->id).$postfix;
            $res[$keyWithPostfix] = $safeStringCastAction->execute($row->title ?? '');
        }

        return $res;
    }
}
