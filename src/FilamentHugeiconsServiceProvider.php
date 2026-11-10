<?php

declare(strict_types=1);

namespace Vendor\FilamentHugeicons;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentHugeiconsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-hugeicons')->hasConfigFile();
    }
}
