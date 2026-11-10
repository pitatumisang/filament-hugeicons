<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons;

use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use EnigmaInc\FilamentHugeicons\Support\IconMappingRegistry;
use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentHugeiconsPlugin implements Plugin
{
    protected ?bool $replaceDefaultIcons = null;

    /** @var array<string, string> */
    protected array $overrides = [];

    public static function make(): static
    {
        $plugin = app(static::class);

        if (! $plugin instanceof static) {
            throw new \LogicException('The plugin binding must resolve to an instance of ' . static::class . '.');
        }

        return $plugin;
    }

    public function getId(): string
    {
        return 'filament-hugeicons';
    }

    public function replaceDefaultIcons(bool $condition = true): static
    {
        $this->replaceDefaultIcons = $condition;

        return $this;
    }

    /** @param array<string, Hugeicon|string> $aliases */
    public function overrideAliases(array $aliases): static
    {
        $this->overrides = array_replace($this->overrides, IconMappingRegistry::normalizeOverrides($aliases));

        return $this;
    }

    public function register(Panel $panel): void
    {
        app(IconMappingRegistry::class)->declare($this->replaceDefaultIcons, $this->overrides);
    }

    public function boot(Panel $panel): void
    {
        app(IconMappingRegistry::class)->declare($this->replaceDefaultIcons, $this->overrides);
    }
}
