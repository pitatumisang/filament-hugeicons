<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests\Unit;

use EnigmaInc\FilamentHugeicons\Development\IconCatalogGenerator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class IconCatalogGeneratorTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        $this->directory = sys_get_temp_dir() . '/hugeicons-' . bin2hex(random_bytes(8));
        mkdir($this->directory);
    }

    protected function tearDown(): void
    {
        foreach (glob($this->directory . '/*') ?: [] as $file) {
            chmod($file, 0644);
            unlink($file);
        }

        rmdir($this->directory);
    }

    public function test_generation_is_sorted_deterministic_and_preserves_word_boundaries(): void
    {
        $generator = new IconCatalogGenerator;
        $entries = [
            ['name' => 'playlist', 'svg' => $this->svg()],
            ['name' => 'play-list', 'svg' => $this->svg()],
            ['name' => '3d-home', 'svg' => $this->svg()],
        ];
        $output = $generator->build($entries, '2.1.0', 'hugeicons', 'fixture');

        self::assertSame($output, $generator->build(array_reverse($entries), '2.1.0', 'hugeicons', 'fixture'));
        self::assertStringContainsString("case Icon3dHome = 'hugeicons-3d-home';", $output['enum']);
        self::assertStringContainsString("case PlayList = 'hugeicons-play-list';", $output['enum']);
        self::assertStringContainsString("case Playlist = 'hugeicons-playlist';", $output['enum']);
        self::assertStringContainsString(hash('sha256', $this->svg()), $output['manifest']);
    }

    public function test_duplicate_backing_values_fail(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Duplicate icon value');
        (new IconCatalogGenerator)->build([
            ['name' => 'home', 'svg' => $this->svg()],
            ['name' => 'home', 'svg' => $this->svg()],
        ], '2.1.0', 'hugeicons', 'fixture');
    }

    public function test_duplicate_case_names_fail(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Duplicate enum case');
        (new IconCatalogGenerator)->build([
            ['name' => 'foo-bar', 'svg' => $this->svg()],
            ['name' => 'foo_bar', 'svg' => $this->svg()],
        ], '2.1.0', 'hugeicons', 'fixture');
    }

    public function test_invalid_and_reserved_names_fail(): void
    {
        foreach (['class', 'bad.name', '-bad', 'bad--name', "bad'icon"] as $name) {
            try {
                (new IconCatalogGenerator)->build([['name' => $name, 'svg' => $this->svg()]], '2.1.0', 'hugeicons', 'fixture');
                self::fail('Invalid name accepted: ' . $name);
            } catch (RuntimeException $exception) {
                self::assertStringContainsString('Invalid icon name', $exception->getMessage());
            }
        }
    }

    public function test_empty_catalog_fails(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('empty');
        (new IconCatalogGenerator)->generate($this->directory, '2.1.0', 'hugeicons', 'fixture');
    }

    public function test_missing_catalog_fails(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('directory');
        (new IconCatalogGenerator)->generate($this->directory . '/absent', '2.1.0', 'hugeicons', 'fixture');
    }

    public function test_unreadable_svg_fails(): void
    {
        file_put_contents($this->directory . '/home.svg', $this->svg());
        chmod($this->directory . '/home.svg', 0000);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unreadable');
        (new IconCatalogGenerator)->generate($this->directory, '2.1.0', 'hugeicons', 'fixture');
    }

    public function test_non_svg_content_fails(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid SVG');
        (new IconCatalogGenerator)->build([['name' => 'home', 'svg' => '<html/>']], '2.1.0', 'hugeicons', 'fixture');
    }

    public function test_empty_svg_content_fails_with_a_catalog_error(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid SVG');
        (new IconCatalogGenerator)->build([['name' => 'home', 'svg' => '']], '2.1.0', 'hugeicons', 'fixture');
    }

    public function test_source_version_and_prefix_are_validated(): void
    {
        foreach ([['2.2.0', 'hugeicons'], ['2.1.0', 'custom']] as [$version, $prefix]) {
            try {
                (new IconCatalogGenerator)->build([['name' => 'home', 'svg' => $this->svg()]], $version, $prefix, 'fixture');
                self::fail('Mismatched source accepted');
            } catch (RuntimeException $exception) {
                self::assertStringContainsString('Unexpected source', $exception->getMessage());
            }
        }
    }

    public function test_files_are_read_from_the_catalog(): void
    {
        file_put_contents($this->directory . '/home.svg', $this->svg());
        self::assertSame(
            (new IconCatalogGenerator)->build([['name' => 'home', 'svg' => $this->svg()]], '2.1.0', 'hugeicons', 'fixture'),
            (new IconCatalogGenerator)->generate($this->directory, '2.1.0', 'hugeicons', 'fixture'),
        );
    }

    public function test_check_detects_either_missing_or_changed_output_without_writing(): void
    {
        $generator = new IconCatalogGenerator;
        $outputs = [$this->directory . '/enum.php' => 'enum', $this->directory . '/manifest.json' => 'manifest'];
        self::assertFalse($generator->writeOrCheck($outputs, true));
        self::assertFileDoesNotExist($this->directory . '/enum.php');
        self::assertTrue($generator->writeOrCheck($outputs, false));
        self::assertTrue($generator->writeOrCheck($outputs, true));

        foreach ($outputs as $path => $contents) {
            file_put_contents($path, 'drift');
            self::assertFalse($generator->writeOrCheck($outputs, true));
            self::assertSame('drift', file_get_contents($path));
            file_put_contents($path, $contents);
        }
    }

    private function svg(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg"><path d="M0 0"/></svg>';
    }
}
