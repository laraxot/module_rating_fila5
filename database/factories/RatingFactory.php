<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Rating\Models\Rating;

/**
 * @extends Factory<Rating>
 */
class RatingFactory extends Factory
{
    protected $model = Rating::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'color' => fake()->safeColorName(),
            'is_disabled' => false,
            'is_readonly' => false,
        ];
    }
}
