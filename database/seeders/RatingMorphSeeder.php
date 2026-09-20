<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Seeders;

use Illuminate\Database\Seeder;

/**
<<<<<<< HEAD
 * Pivot rating_morph owner del dominio Predict — seed via Predict\RatingMorphSeeder.
=======
 * Pivot rating_morph owner del dominio consumer — seed demandato ai seeder del dominio consumer.
>>>>>>> laraxot/dev
 */
class RatingMorphSeeder extends Seeder
{
    public function run(): void
    {
        if (null !== $this->command) {
<<<<<<< HEAD
            $this->command->info('RatingMorphSeeder: pivot demo in Modules\\Predict\\Database\\Seeders\\RatingMorphSeeder.');
=======
            $this->command->info('RatingMorphSeeder: pivot demo demandato ai seeder del dominio consumer.');
>>>>>>> laraxot/dev
        }
    }
}
