<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests\Feature;

use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use EnigmaInc\FilamentHugeicons\Support\IconMappingRegistry;
use EnigmaInc\FilamentHugeicons\Tests\TestCase;
use Filament\Panel;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Heroicon;
use Filament\Support\Icons\IconManager;
use Filament\View\PanelsIconAlias;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Facade;
use InvalidArgumentException;
use LogicException;
use ReflectionClass;

use function Filament\Support\generate_icon_html;

final class ReplacementPolicyTest extends TestCase
{
    public function test_disabled_policy_does_not_apply_overrides(): void
    {
        $registry = $this->registry(false, [PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02]);
        $registry->finalize();
        self::assertNull(FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_enabled_policy_maps_native_aliases_and_preserves_unmapped_fallback(): void
    {
        $this->registry(true)->finalize();
        self::assertSame(Hugeicon::Search01, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        $fallback = generate_icon_html(Heroicon::Home, alias: 'application::unmapped')?->toHtml();
        self::assertSame(generate_icon_html(Heroicon::Home)?->toHtml(), $fallback);
    }

    public function test_fluent_flag_and_overrides_take_precedence_over_config(): void
    {
        $registry = $this->registry(false, [PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search01]);
        $registry->declare(true, [PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02]);
        $registry->finalize();
        self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_explicit_false_wins_over_enabled_config(): void
    {
        $registry = $this->registry(true);
        $registry->declare(false, []);
        $registry->finalize();
        self::assertNull(FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_conflicting_declarations_fail_before_alias_mutation(): void
    {
        $registry = $this->registry(false);
        $registry->declare(true, []);

        try {
            $registry->declare(false, []);
            self::fail('Conflicting policies were accepted');
        } catch (LogicException $exception) {
            self::assertStringContainsString('application-wide', $exception->getMessage());
            self::assertNull(FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        }
    }

    public function test_equivalent_enum_and_string_declarations_ignore_map_order(): void
    {
        $registry = $this->registry(false);
        $registry->declare(true, [PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02, PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM => Hugeicon::Home01]);
        $registry->declare(true, [PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM => Hugeicon::Home01->value, PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02->value]);
        $registry->finalize();
        self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_native_overrides_win_before_and_after_package_application(): void
    {
        FilamentIcon::register([PanelsIconAlias::GLOBAL_SEARCH_FIELD => Heroicon::MagnifyingGlass]);
        $this->registry(true)->finalize();
        self::assertSame(Heroicon::MagnifyingGlass, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        FilamentIcon::register([PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM => Heroicon::Home]);
        self::assertSame(Heroicon::Home, FilamentIcon::resolve(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM));
    }

    public function test_policy_replays_across_scope_resets_and_panels_without_plugin(): void
    {
        $registry = $this->registry(true);
        $registry->finalize();
        $registry->finalize();
        Panel::make()->id('a')->boot();
        Panel::make()->id('b')->boot();
        self::assertSame(Hugeicon::Search01, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        app()->forgetScopedInstances();
        Facade::clearResolvedInstance(IconManager::class);
        self::assertSame(Hugeicon::Search01, app(IconManager::class)->resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_native_panel_icons_win(): void
    {
        $this->registry(true)->finalize();
        Panel::make()->id('custom')->icons([PanelsIconAlias::GLOBAL_SEARCH_FIELD => Heroicon::MagnifyingGlass])->boot();
        self::assertSame(Heroicon::MagnifyingGlass, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
    }

    public function test_late_incompatible_declaration_fails_without_changing_live_aliases(): void
    {
        $registry = $this->registry(true);
        $registry->finalize();
        $this->expectException(LogicException::class);
        $registry->declare(false, []);
    }

    public function test_plugin_merges_overrides_and_detects_mutation_after_registration(): void
    {
        $registry = $this->registry(false);
        app()->instance(IconMappingRegistry::class, $registry);
        $plugin = FilamentHugeiconsPlugin::make()->replaceDefaultIcons()
            ->overrideAliases([PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search01])
            ->overrideAliases([PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02]);
        $panel = Panel::make()->id('a')->plugin($plugin);
        $registry->finalize();
        self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        $plugin->replaceDefaultIcons(false);
        $this->expectException(LogicException::class);
        $panel->boot();
    }

    public function test_invalid_override_types_are_rejected_even_when_disabled(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->registry(false, ['' => Hugeicon::Search01])->finalize();
    }

    public function test_invalid_flag_types_are_not_coerced(): void
    {
        $config = new Repository(['filament-hugeicons' => ['replace_default_icons' => 'false', 'overrides' => []]]);
        $this->expectException(InvalidArgumentException::class);
        (new IconMappingRegistry($config))->finalize();
    }

    public function test_invalid_icon_does_not_partially_apply_the_map(): void
    {
        $registry = $this->registry(true, [PanelsIconAlias::GLOBAL_SEARCH_FIELD => 'unknown-icon-that-does-not-exist']);

        try {
            $registry->finalize();
            app(IconManager::class);
            self::fail('Missing icon accepted');
        } catch (InvalidArgumentException $exception) {
            self::assertStringContainsString(PanelsIconAlias::GLOBAL_SEARCH_FIELD, $exception->getMessage());
            self::assertNull(app(IconManager::class)->resolve(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM));
        }
    }

    public function test_alias_spelling_follows_the_installed_registry_when_merging_overrides(): void
    {
        $canonical = 'forms:components.rich-editor.toolbar.bold';
        $legacy = 'forms::components.rich-editor.toolbar.bold';
        $registry = $this->registry(true, [$canonical => Hugeicon::Search01]);
        $registry->declare(true, [$legacy => Hugeicon::Search02]);
        $registry->finalize();
        if ((new ReflectionClass(IconManager::class))->hasMethod('normalizeAlias')) {
            self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve($canonical));
        } else {
            self::assertSame(Hugeicon::Search01->value, FilamentIcon::resolve($canonical));
        }

        self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve($legacy));
    }

    public function test_plugin_policy_comparison_follows_the_installed_alias_semantics(): void
    {
        $canonical = 'forms:components.rich-editor.toolbar.bold';
        $legacy = 'forms::components.rich-editor.toolbar.bold';
        $registry = $this->registry(false);
        app()->instance(IconMappingRegistry::class, $registry);
        $plugin = FilamentHugeiconsPlugin::make()->replaceDefaultIcons()
            ->overrideAliases([$canonical => Hugeicon::Search01])
            ->overrideAliases([$legacy => Hugeicon::Search02]);
        Panel::make()->id('legacy')->plugin($plugin);
        if ((new ReflectionClass(IconManager::class))->hasMethod('normalizeAlias')) {
            $registry->declare(true, [$canonical => Hugeicon::Search02]);
            $registry->finalize();
            self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve($legacy));
        } else {
            $registry->finalize();
            self::assertSame(Hugeicon::Search01->value, FilamentIcon::resolve($canonical));
            self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve($legacy));
            $this->expectException(LogicException::class);
            $registry->declare(true, [$canonical => Hugeicon::Search02]);
        }
    }

    public function test_override_boundary_rejects_nonarrays_numeric_keys_and_nonicon_values(): void
    {
        foreach ([null, 'not-an-array', [1 => Hugeicon::Search01], [' ' => Hugeicon::Search01], ['alias' => 123], ['alias' => ' '], ['alias' => new \stdClass]] as $invalid) {
            try {
                IconMappingRegistry::normalizeOverrides($invalid);
                self::fail('Invalid override accepted');
            } catch (InvalidArgumentException $exception) {
                self::assertStringContainsString('overrides', $exception->getMessage());
            }
        }
    }

    /** @param array<string, Hugeicon|string> $overrides */
    private function registry(bool $enabled, array $overrides = []): IconMappingRegistry
    {
        return new IconMappingRegistry(new Repository(['filament-hugeicons' => ['replace_default_icons' => $enabled, 'overrides' => $overrides]]));
    }
}
