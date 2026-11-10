<?php

declare(strict_types=1);

use EnigmaInc\FilamentHugeicons\Development\AliasCoverage;

require __DIR__ . '/../vendor/autoload.php';

try {
    if (array_diff(array_slice($argv, 1), ['--check']) !== []) {
        throw new RuntimeException('Usage: php scripts/alias-coverage.php [--check]');
    }

    $path = __DIR__ . '/../docs/default-icon-coverage.md';
    $report = (new AliasCoverage)->report();
    $check = in_array('--check', $argv, true);

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
