<?php

namespace Modules\Rating\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Rating\Models\Rating;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
