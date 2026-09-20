<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;

<<<<<<< HEAD
/**
 * Trait HasRating.
 */
/** @phpstan-ignore trait.unused */
trait HasRating
{
    /** @return MorphToMany<Rating, $this, RatingMorph, 'pivot'> */
    public function ratings(): MorphToMany
    {
        $pivot = new RatingMorph();

        return $this->morphToMany(Rating::class, 'model', $pivot->getTable())
            ->using(RatingMorph::class)
            ->withPivot($pivot->getFillable())
            ->withTimestamps();
    }

    /** @return array<int|string, string> */
=======
/** @phpstan-ignore trait.unused (verificato zero consumer reale il 2026-09-01 — solo riferimenti a `HasRatingContract`/namespace `Actions\HasRating\*`, non `use HasRating;`) */
trait HasRating
{
    /** @return MorphToMany<Rating, Model, RatingMorph, 'pivot'> */
    public function ratings(): MorphToMany
    {
        return $this->morphToManyX(Rating::class, 'model');
    }

    /** @return array<int, string> */
>>>>>>> laraxot/dev
    public function getOptionRatingsIdTitle(): array
    {
        $options = [];
        foreach ($this->ratings()->where('user_id', null)->get() as $rating) {
            if (! $rating instanceof Rating) {
                continue;
            }

<<<<<<< HEAD
            $options[$rating->id] = (string) $rating->title;
=======
            $options[(int) $rating->id] = (string) $rating->title;
>>>>>>> laraxot/dev
        }

        return $options;
    }

<<<<<<< HEAD
    /** @return array<int|string, string> */
=======
    /** @return array<int, string> */
>>>>>>> laraxot/dev
    public function getOptionRatingsIdColor(): array
    {
        $options = [];
        foreach ($this->ratings()->where('user_id', null)->get() as $rating) {
            if (! $rating instanceof Rating) {
                continue;
            }

<<<<<<< HEAD
            $options[$rating->id] = (string) $rating->color;
=======
            $options[(int) $rating->id] = (string) $rating->color;
>>>>>>> laraxot/dev
        }

        return $options;
    }

<<<<<<< HEAD
    /** @return array<int, array<string, mixed>> */
=======
    /**
     * @return array<int, non-empty-array<string, mixed>>
     */
>>>>>>> laraxot/dev
    public function getArrayRatingsWithImage(): array
    {
        $ratings = $this
            ->ratings()
            // ->with('media')
            ->where('user_id', null)
            ->get();
        // ->toArray()

<<<<<<< HEAD
        $ratingsArray = [];
        foreach ($ratings as $key => $rating) {
            /** @var array<string, mixed> $rowData */
            $rowData = $rating->toArray();
            $ratingsArray[$key] = $rowData;
=======
        /** @var array<int, non-empty-array<string, mixed>> $ratings_array */
        $ratings_array = [];
        foreach ($ratings as $key => $rating) {
            /** @var array<string, mixed> $rowData */
            $rowData = $rating->toArray();
>>>>>>> laraxot/dev
            // Use in-memory SVG icons instead of fetching external images
            // Default SVG icons based on rating position
            $svgIcons = [
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm3.53 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.69a.75.75 0 001.5 0v-4.69l1.72 1.72a.75.75 0 001.06 0z" clip-rule="evenodd" /></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72 1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" /></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365-9.75 9.75-4.365 9.75 9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>',
            ];

            // Use media if it already exists, otherwise don't try to create it
<<<<<<< HEAD
            $ratingsArray[$key]['image'] = method_exists($rating, 'getFirstMediaUrl') ? $rating->getFirstMediaUrl('rating') : null;

            // Add SVG icon directly to the array
            $ratingsArray[$key]['svg_icon'] = $svgIcons[$key % count($svgIcons)];
            $ratingsArray[$key]['effect'] = false;
        }

        return $ratingsArray;
=======
            $rowData['image'] = method_exists($rating, 'getFirstMediaUrl') ? $rating->getFirstMediaUrl('rating') : null;

            // Add SVG icon directly to the array
            $rowData['svg_icon'] = $svgIcons[$key % count($svgIcons)];
            $rowData['effect'] = false;
            $ratings_array[$key] = $rowData;
        }

        return $ratings_array;
>>>>>>> laraxot/dev
    }

    public function getBettingUsers(): int
    {
        return RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null)
            ->distinct('user_id')
            ->count('user_id');
    }

<<<<<<< HEAD
    /** @return array<int|string, float|int> */
    public function getRatingsPercentageByUser(): array
    {
        $ratingsOptions = $this->getOptionRatingsIdTitle();
        $result = [];
        foreach (array_keys($ratingsOptions) as $key) {
            $totalCount = RatingMorph::where('model_id', $this->id)
                ->where('user_id', '!=', null)
                ->count();
            if (0 === $totalCount) {
                $totalCount = 1;
            }

            $matchCount = RatingMorph::where('model_id', $this->id)
                ->where('user_id', '!=', null)
                ->where('rating_id', $key)
                ->count();
            $result[$key] = round(100 * $matchCount / $totalCount, 0);
=======
    /** @return array<int, float> */
    public function getRatingsPercentageByUser(): array
    {
        $ratings_options = $this->getOptionRatingsIdTitle();
        $result = [];
        foreach (array_keys($ratings_options) as $key) {
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
            $result[$key] = round(100 * $a / $b, 0);
>>>>>>> laraxot/dev
        }

        return $result;
    }

<<<<<<< HEAD
    /** @return array<int|string, float|int> */
    public function getRatingsPercentageByVolume(): array
    {
        $ratingsOptions = $this->getOptionRatingsIdTitle();
        $result = [];

        $totalVolume = $this->getVolumeCredit();
        if ($totalVolume <= 0) {
            $totalVolume = 1;
        }

        foreach (array_keys($ratingsOptions) as $key) {
            $volume = $this->getVolumeCredit(is_int($key) ? $key : (int) $key);
            $result[$key] = round($volume * 100 / $totalVolume, 0);
=======
    /** @return array<int, float> */
    public function getRatingsPercentageByVolume(): array
    {
        $ratings_options = $this->getOptionRatingsIdTitle();
        $result = [];

        $total_volume = $this->getVolumeCredit();
        if ($total_volume <= 0) {
            $total_volume = 1;
        }

        foreach (array_keys($ratings_options) as $key) {
            $volume = $this->getVolumeCredit(is_int($key) ? $key : (int) $key);
            $result[$key] = round($volume * 100 / $total_volume, 0);
>>>>>>> laraxot/dev
        }

        return $result;
    }

<<<<<<< HEAD
    public function getVolumeCredit(?int $ratingId = null): float
=======
    public function getVolumeCredit(?int $rating_id = null): float
>>>>>>> laraxot/dev
    {
        $query = RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null);

<<<<<<< HEAD
        if (null !== $ratingId) {
            $query->where('rating_id', $ratingId);
=======
        if (null !== $rating_id) {
            $query->where('rating_id', $rating_id);
>>>>>>> laraxot/dev
        }

        return (float) $query->sum('points');
    }
}
