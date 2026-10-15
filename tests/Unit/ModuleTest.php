<?php
namespace Modules\Rating\Tests\Unit;

use Modules\Rating\Tests\TestCase;
use Modules\Rating\Models\Rating;

it('has main model class', function () {
    expect(class_exists(Rating::class))->toBeTrue();
});
