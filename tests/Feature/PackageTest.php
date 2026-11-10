<?php

declare(strict_types=1);

use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;
use EnigmaInc\FilamentHugeicons\FilamentHugeiconsServiceProvider;
use Filament\Panel;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsIconAlias;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

it('boots the package provider without panel plugin registration', function (): void {
    $app = app(Application::class);

    expect($app->getProvider(FilamentHugeiconsServiceProvider::class))
        ->toBeInstanceOf(FilamentHugeiconsServiceProvider::class);
});

it('loads disabled replacement defaults without publishing config', function (): void {
    expect(config('filament-hugeicons.replace_default_icons'))->toBeFalse()
        ->and(config('filament-hugeicons.overrides'))->toBe([]);
});

it('registers the package config for publishing', function (): void {
    expect(ServiceProvider::pathsToPublish(
        FilamentHugeiconsServiceProvider::class,
        'filament-hugeicons-config',
    ))->toBe([
        dirname(__DIR__, 2) . '/src/../config/filament-hugeicons.php' => config_path('filament-hugeicons.php'),
    ]);
});

it('leaves unmapped aliases to Filament defaults when installed', function (): void {
    expect(FilamentIcon::resolve(PanelsIconAlias::USER_MENU_LOGOUT_BUTTON))->toBeNull();
});

it('preserves existing aliases when the plugin is registered without replacement', function (): void {
    FilamentIcon::register([
        PanelsIconAlias::USER_MENU_LOGOUT_BUTTON => Heroicon::ArrowRightOnRectangle,
    ]);

    $plugin = FilamentHugeiconsPlugin::make();
    $panel = Panel::make();
    $plugin->register($panel);
    $plugin->boot($panel);

    expect(FilamentIcon::resolve(PanelsIconAlias::USER_MENU_LOGOUT_BUTTON))
        ->toBe(Heroicon::ArrowRightOnRectangle);
});
