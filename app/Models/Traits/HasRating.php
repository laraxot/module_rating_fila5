<?php

/**
 * --.
 */

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;

/**
 * Trait HasRating.
 */
trait HasRating
{
    //  laravel/Modules/Xot/app/Models/Traits/RelationX.php  poi passare a morphToManyX per standardizzare
    public function ratings(): MorphToMany
    {
        $class = static::class;
        $alias = Str::of(class_basename($class))->snake()->toString();
        Relation::morphMap([
            $alias => $class,
        ]);
        $pivot_class = RatingMorph::class;
        $pivot = app($pivot_class);
        $pivot_table = $pivot->getTable();

        $pivot_table_full = $pivot_table;

        $pivot_fields = array_filter($pivot->getFillable(), function ($field) {
            return ! in_array($field, ['sum_credit_yes', 'sum_credit_no', 'count_credit_yes', 'count_credit_no', 'percentage']);
        });

        return $this->morphToMany(Rating::class, 'model', $pivot_table_full)
            ->using($pivot_class)
            ->withPivot($pivot_fields)
            ->withTimestamps();
    }

    public function getOptionRatingsIdTitle(): array
    {
        // return $this->ratings()->where('user_id', null)->get();
        return Arr::pluck($this->ratings()->where('user_id', null)->get()->toArray(), 'title', 'id');
    }

    public function getOptionRatingsIdColor(): array
    {
        return Arr::pluck($this->ratings()->where('user_id', null)->get()->toArray(), 'color', 'id');
    }

    public function getArrayRatingsWithImage(): array
    {
        $ratings = $this
            ->ratings()
        // ->with('media')
            ->where('user_id', null)
            ->get();
        // ->toArray()

        $ratings_array = [];
        foreach ($ratings as $key => $rating) {
            $ratings_array[$key] = $rating->toArray();
            // Use in-memory SVG icons instead of fetching external images
            // Default SVG icons based on rating position
            $svgIcons = [
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm3.53 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.69a.75.75 0 001.5 0v-4.69l1.72 1.72a.75.75 0 001.06 0z" clip-rule="evenodd" /></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" /></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>',
            ];

            // Use media if it already exists, otherwise don't try to create it
            $ratings_array[$key]['image'] = method_exists($rating, 'getFirstMediaUrl') ? $rating->getFirstMediaUrl('rating') : null;

            // Add SVG icon directly to the array
            $ratings_array[$key]['svg_icon'] = $svgIcons[$key % count($svgIcons)];
            $ratings_array[$key]['effect'] = false;
        }

        return $ratings_array;
    }

    public function getBettingUsers(): int
    {
        return RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null)
            ->distinct('user_id')
            ->count('user_id');
    }

    public function getRatingsPercentageByUser(): array
    {
        $ratings_options = $this->getOptionRatingsIdTitle();
        $result = [];
        foreach ($ratings_options as $key => $value) {
            $b = RatingMorph::where('model_id', $this->id)
                ->where('user_id', '!=', null)
                ->count();
            if (0 === $b) {
                $b = 1;
            }

            $a = RatingMorph::where('model_id', $this->id)
                ->where('user_id', '!=', null)
                ->where('rating_id', $key)
                ->count();
            $result[$key] = round((100 * $a) / $b, 0);
        }

        return $result;
    }

    public function getRatingsPercentageByVolume(): array
    {
        $ratings_options = $this->getOptionRatingsIdTitle();
        $result = [];

        $total_volume = $this->getVolumeCredit();
        if ($total_volume <= 0) {
            $total_volume = 1;
        }

        foreach ($ratings_options as $key => $value) {
            $volume = $this->getVolumeCredit($key);
            $result[$key] = round(($volume * 100) / $total_volume, 0);
        }

        return $result;
    }

    public function getVolumeCredit(?int $rating_id = null): float
    {
        $query = RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null);

        if (null !== $rating_id) {
            $query->where('rating_id', $rating_id);
        }

        return (float) $query->sum('points');
    }
}
