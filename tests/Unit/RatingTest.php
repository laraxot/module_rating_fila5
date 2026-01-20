<?php

declare(strict_types=1);

namespace Modules\Rating\Tests\Unit;

use Modules\Rating\Enums\SupportedLocale;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\Rating\Tests\TestCase;

class RatingTest extends TestCase
{
    public function test_can_create_rating(): void
    {
        $rating = Rating::create([
            'name' => 'Test Rating',
            'color' => '#FF0000',
        ]);

        $this->assertDatabaseHas('ratings', [
            'id' => $rating->id,
            'name' => 'Test Rating',
        ]);
    }

    public function test_can_create_rating_morph(): void
    {
        $rating = Rating::create([
            'name' => 'Test Rating',
        ]);

        $ratingMorph = RatingMorph::create([
            'rating_id' => $rating->id,
            'model_type' => 'test_model',
            'model_id' => 1,
            'value' => 4.5,
            'note' => 'Test note',
            'is_winner' => true,
            'reward' => 10,
        ]);

        $this->assertDatabaseHas('rating_morphs', [
            'id' => $ratingMorph->id,
            'rating_id' => $rating->id,
        ]);
    }

    public function test_supported_locale_enum(): void
    {
        $locale = SupportedLocale::IT;

        $this->assertEquals('it', $locale->value);
        $this->assertEquals('Italiano', $locale->label());

        $localeFromString = SupportedLocale::fromString('en');
        $this->assertEquals(SupportedLocale::EN, $localeFromString);

        $locales = SupportedLocale::toArray();
        $this->assertArrayHasKey('it', $locales);
        $this->assertArrayHasKey('en', $locales);
    }
}
