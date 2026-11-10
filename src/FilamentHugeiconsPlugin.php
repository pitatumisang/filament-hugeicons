<?php

declare(strict_types=1);

namespace Vendor\FilamentHugeicons;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentHugeiconsPlugin implements Plugin
{
    protected bool $replaceDefaultIcons = false;

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

    public function register(Panel $panel): void
    {
        // Explicit Hugeicon enum usage requires no panel registration.
    }

    public function boot(Panel $panel): void
    {
        if (! $this->replaceDefaultIcons) {
            return;
        }

        // TODO: Register verified Filament 5 icon aliases once mappings are validated.
    }
}
