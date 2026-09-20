<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Factories;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Rating\Enums\RuleEnum;
use Modules\Rating\Models\Rating;

/**
 * @extends Factory<Rating>
 */
class RatingFactory extends Factory
{
    /** @var class-string<Rating> */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->words(2, true),
            'color' => $this->faker->hexColor(),
            'txt' => $this->faker->optional()->sentence(),
            'rule' => RuleEnum::ZeroFive,
            'is_disabled' => false,
            'is_readonly' => false,
            'order_column' => $this->faker->numberBetween(0, 100),
        ];
    }
=======
use Modules\Rating\Models\Rating;
use Modules\Rating\Database\Factories\BaseRatingFactory;

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
>>>>>>> laraxot/dev
}
