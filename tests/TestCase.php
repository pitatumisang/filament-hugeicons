<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests;

use EnigmaInc\FilamentHugeicons\FilamentHugeiconsServiceProvider;
use Illuminate\Support\ServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected $enablesPackageDiscoveries = true;

    /**
     * @return list<class-string<ServiceProvider>>
     */
    protected function getPackageProviders($app): array
    {
        return [FilamentHugeiconsServiceProvider::class];
    }
}
