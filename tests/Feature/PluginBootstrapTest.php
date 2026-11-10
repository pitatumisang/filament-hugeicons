<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests\Feature;

use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use EnigmaInc\FilamentHugeicons\Tests\Fixtures\HugeiconsPanelProvider;
use EnigmaInc\FilamentHugeicons\Tests\TestCase;
use Filament\Panel;
use Filament\PanelRegistry;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\IconManager;
use Filament\View\PanelsIconAlias;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;
use LogicException;
use ReflectionProperty;

final class PluginBootstrapTest extends TestCase
{
    /** @return list<class-string<ServiceProvider>> */
    protected function getPackageProviders($app): array
    {
        return [...parent::getPackageProviders($app), HugeiconsPanelProvider::class];
    }

    public function test_plugin_is_collected_before_provider_policy_freezes(): void
    {
        self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        $panel = app(PanelRegistry::class)->get('hugeicons');
        self::assertNotNull($panel);
        $panel->boot();
        Panel::make()->id('without-plugin')->boot();
        self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_plugin_boot_does_not_accumulate_package_callbacks(): void
    {
        $callbacks = new ReflectionProperty(app(), 'afterResolvingCallbacks');
        $before = $callbacks->getValue(app());
        $plugin = FilamentHugeiconsPlugin::make()->replaceDefaultIcons()->overrideAliases([
            PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02,
        ]);
        $panel = Panel::make()->id('consistent')->plugin($plugin);
        $plugin->boot($panel);
        $plugin->boot($panel);
        self::assertSame($before, $callbacks->getValue(app()));

        app()->forgetScopedInstances();
        Facade::clearResolvedInstance(IconManager::class);
        self::assertSame(Hugeicon::Search02->value, app(IconManager::class)->resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_late_conflicting_panel_fails_and_preserves_global_policy(): void
    {
        try {
            Panel::make()->id('conflicting')->plugin(FilamentHugeiconsPlugin::make()->replaceDefaultIcons(false));
            self::fail('Conflicting panel accepted');
        } catch (LogicException $exception) {
            self::assertStringContainsString('application-wide', $exception->getMessage());
            self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        }
    }
}
