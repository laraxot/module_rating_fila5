<?php

declare(strict_types=1);

namespace Modules\Rating\Filament;

use Filament\Panel;
use Modules\Xot\Filament\XotBasePanelProvider;
use Filament\Support\Colors\Color;

class AdminPanelProvider extends XotBasePanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('Rating_admin')
            ->path('Rating/admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: __DIR__.'/Resources', for: 'Modules\\Rating\\Filament\\Resources')
            ->discoverPages(in: __DIR__.'/Pages', for: 'Modules\\Rating\\Filament\\Pages')
            ->discoverWidgets(in: __DIR__.'/Widgets', for: 'Modules\\Rating\\Filament\\Widgets')
            ->discoverClusters(in: __DIR__.'/Clusters', for: 'Modules\\Rating\\Filament\\Clusters');
    }
}
