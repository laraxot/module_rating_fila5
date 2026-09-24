<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Seeders;

use Illuminate\Database\Seeder;

/**
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
 * Pivot rating_morph owner del dominio consumer — seed demandato ai seeder del dominio consumer.
=======
 * Pivot rating_morph owner del dominio Predict — seed via Predict\RatingMorphSeeder.
>>>>>>> e8cf105 (Check & fix styling)
=======
 * Pivot rating_morph owner del dominio Predict — seed via Predict\RatingMorphSeeder.
>>>>>>> 77b9106 (.)
=======
 * Pivot rating_morph owner del dominio Predict — seed via Predict\RatingMorphSeeder.
>>>>>>> c91c8c3 (.)
 */
class RatingMorphSeeder extends Seeder
{
    public function run(): void
    {
        if (null !== $this->command) {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            $this->command->info('RatingMorphSeeder: pivot demo demandato ai seeder del dominio consumer.');
=======
            $this->command->info('RatingMorphSeeder: pivot demo in Modules\\Predict\\Database\\Seeders\\RatingMorphSeeder.');
>>>>>>> e8cf105 (Check & fix styling)
=======
            $this->command->info('RatingMorphSeeder: pivot demo in Modules\\Predict\\Database\\Seeders\\RatingMorphSeeder.');
>>>>>>> 77b9106 (.)
=======
            $this->command->info('RatingMorphSeeder: pivot demo in Modules\\Predict\\Database\\Seeders\\RatingMorphSeeder.');
>>>>>>> c91c8c3 (.)
        }
    }
}
