<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Support;

use BladeUI\Icons\Exceptions\SvgNotFound;
use BladeUI\Icons\Factory;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use EnigmaInc\FilamentHugeicons\Mappings\DefaultIconMappings;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\IconManager;
use Illuminate\Contracts\Config\Repository;
use InvalidArgumentException;
use LogicException;
use ReflectionClass;

final class IconMappingRegistry
{
    /** @var array{enabled: bool, overrides: array<string, string>}|null */
    private ?array $declaration = null;

    /** @var array{enabled: bool, overrides: array<string, string>}|null */
    private ?array $policy = null;

    public function __construct(private readonly Repository $config) {}

    /** @param array<string, Hugeicon|string> $overrides */
    public function declare(?bool $enabled, array $overrides): void
    {
        $settings = $this->settings($enabled, $overrides);
        $existing = $this->policy ?? $this->declaration;

        if ($existing !== null && $existing !== $settings) {
            throw new LogicException('Hugeicons replacement is application-wide. All plugin declarations must agree and cannot change after application bootstrap.');
        }

        $this->declaration = $settings;
    }

    public function finalize(): void
    {
        if ($this->policy !== null) {
            return;
        }

        $policy = $this->declaration ?? $this->settings(null, []);

        if (! $policy['enabled']) {
            $this->policy = $policy;

            return;
        }

        $mappings = array_replace(DefaultIconMappings::all(), $policy['overrides']);
        $this->validateIcons($mappings);
        $this->policy = $policy;

        FilamentIcon::resolved(function (IconManager $manager) use ($mappings): void {
            $this->validateIcons($mappings);
            $missing = [];

            foreach ($mappings as $alias => $icon) {
                if ($manager->resolve($alias) === null) {
                    $missing[$alias] = $icon;
                }
            }

            $manager->register($missing);
        });
    }

    /** @return array<string, string> */
    public static function normalizeOverrides(mixed $overrides): array
    {
        if (! is_array($overrides)) {
            throw new InvalidArgumentException('Hugeicons overrides must be an array of alias strings to Hugeicon cases or registered icon strings.');
        }

        $normalized = [];

        foreach ($overrides as $alias => $icon) {
            if (! is_string($alias) || trim($alias) === '' || (! $icon instanceof Hugeicon && (! is_string($icon) || trim($icon) === ''))) {
                throw new InvalidArgumentException('Hugeicons overrides require nonempty alias strings and Hugeicon cases or nonempty registered icon strings.');
            }

            $key = self::normalizeAlias($alias);
            $normalized[$key] = $icon instanceof Hugeicon ? $icon->value : $icon;
        }

        ksort($normalized);

        return $normalized;
    }

    private static function normalizeAlias(string $alias): string
    {
        $manager = new ReflectionClass(IconManager::class);

        if (! $manager->hasMethod('normalizeAlias')) {
            return $alias;
        }

        $normalized = $manager->getMethod('normalizeAlias')->invoke(null, $alias);

        if (! is_string($normalized)) {
            throw new LogicException('Filament alias normalization must return a string.');
        }

        return $normalized;
    }

    /**
     * @param  array<string, Hugeicon|string>  $overrides
     * @return array{enabled: bool, overrides: array<string, string>}
     */
    private function settings(?bool $enabled, array $overrides): array
    {
        $configuredFlag = $this->config->get('filament-hugeicons.replace_default_icons', false);

        if (! is_bool($configuredFlag)) {
            throw new InvalidArgumentException('filament-hugeicons.replace_default_icons must be a boolean.');
        }

        $merged = array_replace(self::normalizeOverrides($this->config->get('filament-hugeicons.overrides', [])), self::normalizeOverrides($overrides));
        ksort($merged);

        return ['enabled' => $enabled ?? $configuredFlag, 'overrides' => $merged];
    }

    /** @param array<string, Hugeicon|string> $mappings */
    private function validateIcons(array $mappings): void
    {
        $factory = app(Factory::class);

        foreach ($mappings as $alias => $icon) {
            try {
                $factory->svg($icon instanceof Hugeicon ? $icon->value : $icon);
            } catch (SvgNotFound $exception) {
                throw new InvalidArgumentException('Cannot resolve Hugeicons replacement for alias [' . $alias . ']. Check the icon name and Blade Icons prefix.', $exception->getCode(), previous: $exception);
            }
        }
    }
}
