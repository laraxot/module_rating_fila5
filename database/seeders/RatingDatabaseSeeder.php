<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Orchestratore Rating — N modelli owner = N {Model}Seeder (regola Laraxot).
 */
class RatingDatabaseSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        if ($this->command !== null) {
=======
        if (null !== $this->command) {
>>>>>>> laraxot/dev
            $this->command->info('RatingDatabaseSeeder: entity seeders…');
        }

        $this->call([
            RatingSeeder::class,
            RatingMorphSeeder::class,
        ]);

<<<<<<< HEAD
        if ($this->command !== null) {
=======
        if (null !== $this->command) {
>>>>>>> laraxot/dev
            $this->command->info('RatingDatabaseSeeder: completato.');
        }
    }
}
