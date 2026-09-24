<?php

declare(strict_types=1);

namespace Modules\Rating\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Rating\Models\Rating;

/**
 * <<<<<<< HEAD
 * <<<<<<< HEAD
 * Rating base Sì/No — schema ratings (title, color) usati da seeder di dominio.
 * =======
 * Rating base Sì/No — schema ratings (title, color) usati da PredictSeeder.
 * >>>>>>> e8cf105 (Check & fix styling)
 * =======
 * Rating base Sì/No — schema ratings (title, color) usati da PredictSeeder.
 * >>>>>>> 77b9106 (.).
 */
class RatingSeeder extends Seeder
{
    public function run(): void
    {
        Rating::query()->firstOrCreate(
            ['title' => 'Sì'],
            ['color' => '#10B981'],
        );

        Rating::query()->firstOrCreate(
            ['title' => 'No'],
            ['color' => '#EF4444'],
        );
    }
}
