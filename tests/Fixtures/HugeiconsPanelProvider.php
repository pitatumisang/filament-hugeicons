<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests\Fixtures;

use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\View\PanelsIconAlias;

final class HugeiconsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel->id('hugeicons')->plugin(
            FilamentHugeiconsPlugin::make()->replaceDefaultIcons()->overrideAliases([
                PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02,
            ]),
        );
    }
}
