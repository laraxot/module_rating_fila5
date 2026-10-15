<?php

declare(strict_types=1);

namespace Tests\Modules\Rating\Fixtures;

use Illuminate\Database\Eloquent\Model;

/**
 * Host concreto per ownership via attributi Eloquent (niente classe anonima).
 */
final class RatedModelStub extends Model
    public $id = 0;
{
    protected $table = 'rated_stub';
}
