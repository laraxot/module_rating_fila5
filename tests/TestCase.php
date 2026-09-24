<?php

declare(strict_types=1);

namespace Modules\Rating\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Modules\Rating\Providers\RatingServiceProvider;
use Modules\Xot\Tests\XotBaseTestCase;

/**
 * Base test case for Rating module.
 *
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
 * Uses shared sqlite from database.sqlite (no migrate:fresh / RefreshDatabase).
=======
 * Uses shared sqlite from fixcity_data.sqlite (no migrate:fresh / RefreshDatabase).
>>>>>>> e8cf105 (Check & fix styling)
=======
 * Uses shared sqlite from fixcity_data.sqlite (no migrate:fresh / RefreshDatabase).
>>>>>>> 77b9106 (.)
=======
 * Uses shared sqlite from fixcity_data.sqlite (no migrate:fresh / RefreshDatabase).
>>>>>>> c91c8c3 (.)
 */
abstract class TestCase extends XotBaseTestCase
{
    use DatabaseTransactions;

    /** @var list<string> */
    protected $connectionsToTransact = ['rating', 'sqlite', 'xot'];

    /**
     * @return array<int, class-string>
     */
    protected function getPackageProviders(Application $app): array
    {
        return [
            ...parent::getPackageProviders($app),
            RatingServiceProvider::class,
        ];
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * Lo sqlite condiviso (`database/database.sqlite`) non contiene per forza le tabelle
     * del modulo: le migration non vengono lanciate dai test (mai `RefreshDatabase`).
     * I test che toccano il DB vanno saltati, non falliti: è un blocco d'ambiente.
     */
    public static function ratingDbUnavailable(): bool
    {
        try {
            DB::connection('rating')->getPdo();

            return ! DB::connection('rating')->getSchemaBuilder()->hasTable('ratings');
        } catch (\Throwable) {
            return true;
        }
    }

=======
>>>>>>> e8cf105 (Check & fix styling)
=======
>>>>>>> 77b9106 (.)
=======
>>>>>>> c91c8c3 (.)
    protected function setUp(): void
    {
        parent::setUp();

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        $database = self::sharedSqlitePath();
=======
        $database = database_path('fixcity_data.sqlite');
>>>>>>> e8cf105 (Check & fix styling)
=======
        $database = database_path('fixcity_data.sqlite');
>>>>>>> 77b9106 (.)
=======
        $database = database_path('fixcity_data.sqlite');
>>>>>>> c91c8c3 (.)

        /** @var array<string, array<string, mixed>> $connections */
        $connections = config('database.connections', []);

        foreach (array_keys($connections) as $connection) {
            if ('sqlite' !== config("database.connections.{$connection}.driver")) {
                continue;
            }

            $this->app['config']->set("database.connections.{$connection}.database", $database);
            DB::purge($connection);
        }
    }
}
