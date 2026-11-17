<?php

declare(strict_types=1);

namespace Modules\Rating\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Modules\Rating\Filament\Resources\RatingResource\Pages\ListRatings;
use Modules\Xot\Tests\XotBaseTestCase;

/**
 * Base test case for Rating module.
 *
 * Uses shared sqlite from .env.testing; DatabaseTransactions for isolation.
 */
abstract class TestCase extends XotBaseTestCase
{
    use DatabaseTransactions;

    /** @var list<string> */
    protected $connectionsToTransact = ['sqlite', 'rating', 'user'];

    public ?ListRatings $page = null;

    /**
     * @return array<int, class-string<ServiceProvider>>
     */
    protected function getPackageProviders(Application $app): array
    {
        return parent::getPackageProviders($app);
    }

    protected function setUp(): void
    {
        $this->prepareSharedSqliteForTesting();

        parent::setUp();

        $database = database_path('database.sqlite');

        /** @var array<string, array<string, mixed>> $connections */
        $connections = config('database.connections', []);
        foreach (array_keys($connections) as $connection) {
            if (config("database.connections.{$connection}.driver") !== 'sqlite') {
                continue;
            }

            $this->app['config']->set("database.connections.{$connection}.database", $database);
            DB::purge($connection);
        }
    }
}
