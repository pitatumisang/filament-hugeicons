<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Development;

use Composer\InstalledVersions;
use EnigmaInc\FilamentHugeicons\Mappings\DefaultIconMappings;
use Filament\Actions\View\ActionsIconAlias;
use Filament\Forms\View\FormsIconAlias;
use Filament\Infolists\View\InfolistsIconAlias;
use Filament\Notifications\View\NotificationsIconAlias;
use Filament\QueryBuilder\View\QueryBuilderIconAlias;
use Filament\Schemas\View\SchemasIconAlias;
use Filament\Support\View\SupportIconAlias;
use Filament\Tables\View\TablesIconAlias;
use Filament\View\PanelsIconAlias;
use Filament\Widgets\View\WidgetsIconAlias;
use ReflectionClass;
use RuntimeException;

/** Development-only inventory; production mappings use direct upstream constants. */
final class AliasCoverage
{
    public const REFERENCE_VERSION = '5.11.2';

    /** @return array<string, string> Alias => canonical constant. */
    public function aliases(): array
    {
        $aliases = [];

        $classes = [ActionsIconAlias::class, FormsIconAlias::class, InfolistsIconAlias::class, NotificationsIconAlias::class, QueryBuilderIconAlias::class, SupportIconAlias::class, TablesIconAlias::class, PanelsIconAlias::class, WidgetsIconAlias::class];

        if (class_exists(SchemasIconAlias::class)) {
            $classes[] = SchemasIconAlias::class;
        }

        foreach ($classes as $class) {
            foreach ((new ReflectionClass($class))->getReflectionConstants() as $constant) {
                if (str_contains($constant->getDocComment() ?: '', '@deprecated')) {
                    continue;
                }

                $value = $constant->getValue();

                if (is_string($value)) {
                    $aliases[$value] ??= $class . '::' . $constant->getName();
                }
            }
        }

        ksort($aliases);

        return $aliases;
    }

    public function isReferenceVersion(): bool
    {
        return InstalledVersions::getVersion('filament/filament') === self::REFERENCE_VERSION . '.0';
    }

    public function validateMappings(): void
    {
        $aliases = $this->aliases();

        foreach (DefaultIconMappings::all() as $alias => $icon) {
            if (! isset($aliases[$alias])) {
                throw new RuntimeException('Mapped alias [' . $alias . '] is absent from the installed Filament inventory.');
            }
        }
    }

    public function report(): string
    {
        $aliases = $this->aliases();
        $map = DefaultIconMappings::all();
        $version = InstalledVersions::getPrettyVersion('filament/filament') ?? 'unknown';
        $lines = [
            '# Default icon coverage',
            '',
            'Generated against Filament ' . $version . '. This reports the installed version, not a tested compatibility matrix.',
            '',
            'Run `php scripts/alias-coverage.php` to regenerate; `php scripts/alias-coverage.php --check` checks drift without writing.',
            '',
            'Coverage: ' . count($map) . ' mapped / ' . count($aliases) . ' canonical aliases. Deprecated constants are excluded; equivalent alias values are counted once. Unmapped aliases retain their Filament defaults.',
            '',
            'Mappings are curated for common interface roles. Specialized editors and uncertain equivalents are intentionally omitted. Directional controls include separate RTL mappings. Replacement is optional and application-wide; see the README for opt-in and override precedence.',
        ];
        $groups = [];

        foreach ($aliases as $alias => $constant) {
            [$class] = explode('::', $constant, 2);
            $groups[$class][$alias] = $constant;
        }

        ksort($groups);

        foreach ($groups as $class => $entries) {
            $lines[] = '';
            $lines[] = '## `' . $class . '`';
            $lines[] = '';
            $lines[] = '| Constant | Alias | Hugeicon |';
            $lines[] = '| --- | --- | --- |';

            foreach ($entries as $alias => $constant) {
                [, $name] = explode('::', $constant, 2);
                $lines[] = '| `' . $name . '` | `' . $alias . '` | ' . (isset($map[$alias]) ? '`' . $map[$alias]->name . '`' : 'Unmapped') . ' |';
            }
        }

        return implode("\n", $lines) . "\n";
    }
}
