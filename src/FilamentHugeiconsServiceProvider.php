<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentHugeiconsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-hugeicons')->hasConfigFile();
    }
}
