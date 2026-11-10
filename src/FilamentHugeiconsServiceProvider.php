<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons;

use EnigmaInc\FilamentHugeicons\Support\IconMappingRegistry;
use Filament\PanelRegistry;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentHugeiconsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-hugeicons')->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(IconMappingRegistry::class);
    }

    public function packageBooted(): void
    {
        $this->app->booted(function (): void {
            // Panel providers declare their plugins while the panel registry resolves.
            $this->app->make(PanelRegistry::class);
            $this->app->make(IconMappingRegistry::class)->finalize();
        });
    }
}
