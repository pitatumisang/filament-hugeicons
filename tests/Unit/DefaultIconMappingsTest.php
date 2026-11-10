<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests\Unit;

use Composer\InstalledVersions;
use EnigmaInc\FilamentHugeicons\Development\AliasCoverage;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use EnigmaInc\FilamentHugeicons\Mappings\DefaultIconMappings;
use Filament\Support\View\SupportIconAlias;
use Filament\View\PanelsIconAlias;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

final class DefaultIconMappingsTest extends TestCase
{
    public function test_every_mapping_is_an_upstream_alias_and_real_svg(): void
    {
        $aliases = (new AliasCoverage)->aliases();
        $source = InstalledVersions::getInstallPath('afatmustafa/blade-hugeicons');
        self::assertNotNull($source);
        self::assertGreaterThanOrEqual(50, count(DefaultIconMappings::all()));

        foreach (DefaultIconMappings::all() as $alias => $icon) {
            self::assertArrayHasKey($alias, $aliases);
            self::assertFileExists($source . '/resources/svg/' . substr($icon->value, strlen('hugeicons-')) . '.svg');
        }
    }

    public function test_directional_aliases_match_upstream_rtl_semantics(): void
    {
        $map = DefaultIconMappings::all();
        self::assertSame(Hugeicon::ArrowLeft01, $map[PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON]);
        self::assertSame(Hugeicon::ArrowRight01, $map[PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON_RTL]);
        self::assertSame(Hugeicon::ArrowRight01, $map[SupportIconAlias::PAGINATION_NEXT_BUTTON]);
        self::assertSame(Hugeicon::ArrowLeft01, $map[SupportIconAlias::PAGINATION_NEXT_BUTTON_RTL]);
        self::assertSame(Hugeicon::ArrowLeftDouble, $map[SupportIconAlias::PAGINATION_FIRST_BUTTON]);
        self::assertSame(Hugeicon::ArrowRightDouble, $map[SupportIconAlias::PAGINATION_FIRST_BUTTON_RTL]);
    }

    public function test_coverage_is_canonical_deterministic_and_current(): void
    {
        $coverage = new AliasCoverage;
        $aliases = $coverage->aliases();
        self::assertArrayHasKey(PanelsIconAlias::GLOBAL_SEARCH_FIELD, $aliases);
        $report = $coverage->report();
        self::assertSame($report, $coverage->report());
        if (InstalledVersions::getVersion('filament/filament') === '5.11.2.0') {
            self::assertSame($report, file_get_contents(__DIR__ . '/../../docs/default-icon-coverage.md'));
        }

        self::assertStringContainsString('| `GLOBAL_SEARCH_FIELD` |', $report);
        self::assertStringContainsString((string) InstalledVersions::getPrettyVersion('filament/filament'), $report);
    }

    public function test_reference_check_rejects_a_nonreference_dependency_version(): void
    {
        $process = new Process([PHP_BINARY, __DIR__ . '/../../scripts/alias-coverage.php', '--check-reference']);
        $process->run();

        if (InstalledVersions::getVersion('filament/filament') === '5.11.2.0') {
            self::assertSame(0, $process->getExitCode(), $process->getErrorOutput());
            self::assertStringContainsString('up to date', $process->getOutput());
        } else {
            self::assertSame(1, $process->getExitCode());
            self::assertStringContainsString('requires Filament 5.11.2', $process->getErrorOutput());
        }
    }
}
