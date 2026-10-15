<?php

declare(strict_types=1);

namespace Tests\Modules\Rating\Unit;

use Illuminate\View\Component;
use Tests\Modules\Rating\TestCase;
use Modules\Rating\View\Components\Dashboard\Item;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

test('Item è un componente Blade che non renderizza nulla', function (): void {
    // Contratto reale: `render()` ritorna la stringa vuota. Il componente è registrato ma
    // non ha ancora una view — segnalato in docs/testing-and-coverage.md.
    $item = new Item();

    Assert::assertInstanceOf(Component::class, $item);
    Assert::assertSame('', $item->render());
});
