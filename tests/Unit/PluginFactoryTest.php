<?php

declare(strict_types=1);

use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;
use Illuminate\Container\Container;

it('resolves the plugin from its container binding', function (): void {
    $previousContainer = Container::getInstance();
    $container = new Container;
    Container::setInstance($container);

    try {
        $plugin = new FilamentHugeiconsPlugin;
        $container->instance(FilamentHugeiconsPlugin::class, $plugin);

        expect(FilamentHugeiconsPlugin::make())->toBe($plugin);
    } finally {
        Container::setInstance($previousContainer);
    }
});

it('rejects a container binding that violates the plugin return type', function (): void {
    $previousContainer = Container::getInstance();
    $container = new Container;
    Container::setInstance($container);

    try {
        $container->instance(FilamentHugeiconsPlugin::class, new stdClass);

        expect(fn (): FilamentHugeiconsPlugin => FilamentHugeiconsPlugin::make())
            ->toThrow(LogicException::class, 'The plugin binding must resolve to an instance of');
    } finally {
        Container::setInstance($previousContainer);
    }
});
