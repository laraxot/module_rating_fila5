<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

use Modules\Xot\Models\XotBaseModel;

/**
 * Class BaseModel.
 */
abstract class BaseModel extends XotBaseModel
{
    /** @var string */
    protected $connection = 'rating';

    /** @return array<string, string> */
    public function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',
            // 'published_at' => 'datetime:Y-m-d', // da verificare
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
