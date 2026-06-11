<?php

declare(strict_types=1);

namespace Modules\Rating\Tests;

use Illuminate\Support\Facades\Artisan;
use Modules\Xot\Tests\XotBaseTestCase;

abstract class TestCase extends XotBaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Esegui le migrazioni necessarie per i test
        Artisan::call('migrate:fresh', [
            '--path' => 'Modules/Rating/database/migrations',
            '--database' => 'sqlite',
        ]);
    }
}
