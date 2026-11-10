<?php

declare(strict_types=1);

use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;
use EnigmaInc\FilamentHugeicons\FilamentHugeiconsServiceProvider;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Container\Container;
use Spatie\LaravelPackageTools\PackageServiceProvider;

arch('package PHP files use strict types', function (): void {
    expect('EnigmaInc\FilamentHugeicons')
        ->toUseStrictTypes();
})->group('arch');

arch('production code does not use debugging or process termination', function (): void {
    expect(['dd', 'ddd', 'dump', 'var_dump', 'print_r', 'die', 'exit'])
        ->not->toBeUsed();
})->group('arch');

arch('production code is independent of test tooling and database models', function (): void {
    expect('EnigmaInc\FilamentHugeicons')
        ->not->toUse(['Pest', 'PHPUnit', 'Orchestra\Testbench', 'Illuminate\Database\Eloquent']);
})->group('arch');

arch('the public icon API is a string backed enum', function (): void {
    expect(Hugeicon::class)
        ->toBeStringBackedEnum();
})->group('arch');

arch('icons remain independent of panel lifecycle and container resolution', function (): void {
    expect('EnigmaInc\FilamentHugeicons\Icons')
        ->not->toUse([Panel::class, Plugin::class, Container::class, 'app', 'resolve']);
})->group('arch');

arch('the plugin follows the native Filament contract', function (): void {
    expect(FilamentHugeiconsPlugin::class)
        ->toImplement(Plugin::class);
})->group('arch');

arch('the provider uses Laravel Package Tools', function (): void {
    expect(FilamentHugeiconsServiceProvider::class)
        ->toExtend(PackageServiceProvider::class);
})->group('arch');
