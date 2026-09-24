<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Factories;

<<<<<<< HEAD
use Modules\Rating\Models\Rating;

/**
 * La forma del dato sta in {@see BaseRatingFactory}, nel modulo che possiede il concetto.
 * Qui si dichiara **solo** il modello: e' quello che porta con se' la connection.
 *
 * @extends BaseRatingFactory<Rating>
 */
class RatingFactory extends BaseRatingFactory
{
    /** @var class-string<Rating> */
    protected $model = Rating::class;
=======
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Rating\Models\Rating;

/**
 * @extends Factory<Rating>
 */
class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     */
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
>>>>>>> 2025498 (.)
}
