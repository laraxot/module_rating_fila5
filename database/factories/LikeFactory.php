<?php

namespace Modules\Rating\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Rating\Models\Like::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

