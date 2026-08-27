<?php

namespace Modules\Rating\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< .merge_file_5p0cdh
use Modules\Rating\Models\Like;

/**
 * @extends Factory<Like>
 */
=======

>>>>>>> .merge_file_o4PHgX
class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< .merge_file_5p0cdh
     *
     * @var class-string<Like>
     */
    protected $model = Like::class;
=======
     */
    protected $model = \Modules\Rating\Models\Like::class;
>>>>>>> .merge_file_o4PHgX

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

