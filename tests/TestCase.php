<?php

namespace Modules\Rating\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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
