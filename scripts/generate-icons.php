<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use EnigmaInc\FilamentHugeicons\Development\IconCatalogGenerator;

require __DIR__ . '/../vendor/autoload.php';

try {
    if (array_diff(array_slice($argv, 1), ['--check']) !== []) {
        throw new RuntimeException('Usage: php scripts/generate-icons.php [--check]');
    }

    $package = 'afatmustafa/blade-hugeicons';
    $path = InstalledVersions::getInstallPath($package);
    $version = InstalledVersions::getPrettyVersion($package);
    $reference = InstalledVersions::getReference($package);

    if ($path === null || $version === null || $reference === null) {
        throw new RuntimeException('Install the pinned Blade Hugeicons dependency first.');
    }

    $config = require $path . '/config/blade-hugeicons.php';

    if (! is_array($config) || ! isset($config['prefix']) || ! is_string($config['prefix'])) {
        throw new RuntimeException('Unexpected source prefix configuration.');
    }

    $generator = new IconCatalogGenerator;
    $output = $generator->generate($path . '/resources/svg', ltrim($version, 'v'), $config['prefix'], $reference);
    $check = in_array('--check', $argv, true);
    $matches = $generator->writeOrCheck([
        __DIR__ . '/../src/Icons/Hugeicon.php' => $output['enum'],
        __DIR__ . '/../resources/icon-manifest.json' => $output['manifest'],
    ], $check);

    if (! $matches) {
        throw new RuntimeException('Generated icon catalog has drifted. Run composer icons:generate.');
    }

    fwrite(STDOUT, $check ? "Icon catalog is up to date.\n" : "Generated icon enum and manifest.\n");
} catch (Throwable $exception) {
    fwrite(STDERR, $exception->getMessage() . "\n");
    exit(1);
}
