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
 * Uses shared sqlite from database.sqlite (no migrate:fresh / RefreshDatabase).
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

    protected function setUp(): void
    {
        parent::setUp();

        $database = database_path('database.sqlite');

        /** @var array<string, array<string, mixed>> $connections */
        $connections = config('database.connections', []);

        foreach (array_keys($connections) as $connection) {
<<<<<<< HEAD
            if (config("database.connections.{$connection}.driver") !== 'sqlite') {
=======
            if ('sqlite' !== config("database.connections.{$connection}.driver")) {
>>>>>>> laraxot/dev
                continue;
            }

            $this->app['config']->set("database.connections.{$connection}.database", $database);
            DB::purge($connection);
        }
    }
}
