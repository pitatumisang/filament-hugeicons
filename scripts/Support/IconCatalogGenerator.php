<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Development;

use DOMDocument;
use RuntimeException;

final class IconCatalogGenerator
{
    /** @return array{enum: string, manifest: string} */
    public function generate(string $directory, string $version, string $prefix, string $reference): array
    {
        if (! is_dir($directory)) {
            throw new RuntimeException('Missing catalog directory: ' . $directory);
        }

        $files = glob($directory . '/*.svg');

        if ($files === false) {
            throw new RuntimeException('Cannot list catalog directory: ' . $directory);
        }

        $entries = [];

        foreach ($files as $file) {
            $permissions = fileperms($file);

            if (! is_file($file) || ! is_readable($file) || $permissions === false || ($permissions & 0444) === 0) {
                throw new RuntimeException('Unreadable SVG: ' . $file);
            }

            $svg = file_get_contents($file);

            if ($svg === false) {
                throw new RuntimeException('Unreadable SVG: ' . $file);
            }

            $entries[] = ['name' => basename($file, '.svg'), 'svg' => $svg];
        }

        return $this->build($entries, $version, $prefix, $reference);
    }

    /**
     * @param  list<array{name: string, svg: string}>  $entries
     * @return array{enum: string, manifest: string}
     */
    public function build(array $entries, string $version, string $prefix, string $reference): array
    {
        if ($version !== '2.1.0' || $prefix !== 'hugeicons' || $reference === '') {
            throw new RuntimeException('Unexpected source version, prefix, or empty reference.');
        }

        if ($entries === []) {
            throw new RuntimeException('The icon catalog is empty.');
        }

        usort($entries, static fn (array $left, array $right): int => strcmp($left['name'], $right['name']));

        $cases = [];
        $values = [];
        $icons = [];
        $lines = [];

        foreach ($entries as $entry) {
            $name = $entry['name'];

            if (! preg_match('/\A[A-Za-z0-9]+(?:[-_][A-Za-z0-9]+)*\z/', $name)) {
                throw new RuntimeException('Invalid icon name: ' . $name);
            }

            $case = implode('', array_map(ucfirst(...), preg_split('/[-_]/', $name) ?: []));

            if (ctype_digit($case[0])) {
                $case = 'Icon' . $case;
            }

            if (strtolower($case) === 'class') {
                throw new RuntimeException('Invalid icon name: ' . $name);
            }

            $value = $prefix . '-' . $name;

            if (isset($values[$value])) {
                throw new RuntimeException('Duplicate icon value: ' . $value);
            }

            if (isset($cases[$case])) {
                throw new RuntimeException('Duplicate enum case: ' . $case);
            }

            $this->validateSvg($entry['svg'], $name);
            $cases[$case] = true;
            $values[$value] = true;
            $lines[] = "    case {$case} = '{$value}';";
            $icons[] = ['case' => $case, 'name' => $name, 'value' => $value, 'sha256' => hash('sha256', $entry['svg'])];
        }

        $enum = "<?php\n\ndeclare(strict_types=1);\n\nnamespace EnigmaInc\\FilamentHugeicons\\Icons;\n\n/**\n * Generated from afatmustafa/blade-hugeicons 2.1.0. Do not edit manually.\n */\nenum Hugeicon: string\n{\n" . implode("\n", $lines) . "\n}\n";
        $manifest = json_encode([
            'source' => ['package' => 'afatmustafa/blade-hugeicons', 'version' => $version, 'reference' => $reference, 'prefix' => $prefix],
            'count' => count($icons),
            'icons' => $icons,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR) . "\n";

        return ['enum' => $enum, 'manifest' => $manifest];
    }

    /** @param array<string, string> $outputs */
    public function writeOrCheck(array $outputs, bool $check): bool
    {
        if ($check) {
            foreach ($outputs as $path => $contents) {
                if (! is_file($path) || file_get_contents($path) !== $contents) {
                    return false;
                }
            }

            return true;
        }

        foreach ($outputs as $path => $contents) {
            if (file_put_contents($path, $contents) !== strlen($contents)) {
                throw new RuntimeException('Cannot write generated file: ' . $path);
            }
        }

        return true;
    }

    private function validateSvg(string $svg, string $name): void
    {
        $previous = libxml_use_internal_errors(true);

        try {
            $document = new DOMDocument;

            if ($svg === '' || ! $document->loadXML($svg, LIBXML_NONET) || $document->documentElement?->localName !== 'svg' || $document->documentElement->namespaceURI !== 'http://www.w3.org/2000/svg') {
                throw new RuntimeException('Invalid SVG: ' . $name);
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
    }
}
