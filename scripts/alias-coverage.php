<?php

declare(strict_types=1);

use EnigmaInc\FilamentHugeicons\Development\AliasCoverage;

require __DIR__ . '/../vendor/autoload.php';

try {
    if (array_diff(array_slice($argv, 1), ['--check', '--check-reference']) !== []) {
        throw new RuntimeException('Usage: php scripts/alias-coverage.php [--check|--check-reference]');
    }

    $path = __DIR__ . '/../docs/default-icon-coverage.md';
    $coverage = new AliasCoverage;
    $checkReference = in_array('--check-reference', $argv, true);
    $check = $checkReference || in_array('--check', $argv, true);

    if (($checkReference || ! $check) && ! $coverage->isReferenceVersion()) {
        throw new RuntimeException('The reference report requires Filament ' . AliasCoverage::REFERENCE_VERSION . '. Install that exact version before checking or regenerating it.');
    }

    $coverage->validateMappings();
    $report = $coverage->report();

    if ($check && ! $coverage->isReferenceVersion()) {
        fwrite(STDOUT, 'Installed alias mappings are valid. Reference report drift is checked separately on Filament ' . AliasCoverage::REFERENCE_VERSION . ".\n");
        exit(0);
    }

    if ($check) {
        if (! is_file($path) || file_get_contents($path) !== $report) {
            throw new RuntimeException('Alias coverage has drifted. Run php scripts/alias-coverage.php.');
        }
    } elseif (file_put_contents($path, $report) === false) {
        throw new RuntimeException('Unable to write alias coverage report.');
    }

    fwrite(STDOUT, $check ? "Alias coverage is up to date.\n" : "Generated alias coverage report.\n");
} catch (Throwable $exception) {
    fwrite(STDERR, $exception->getMessage() . "\n");
    exit(1);
}
