<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests\Feature;

use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use EnigmaInc\FilamentHugeicons\Tests\TestCase;
use Filament\Support\Facades\FilamentIcon;
use Filament\View\PanelsIconAlias;

use function Filament\Support\generate_icon_html;

final class ConfigReplacementTest extends TestCase
{
    protected function defineEnvironment($app): void
    {
        $app['config']->set('filament-hugeicons', [
            'replace_default_icons' => true,
            'overrides' => [
                PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02,
                PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM => Hugeicon::Home02->value,
            ],
        ]);
    }

    public function test_config_only_opt_in_renders_without_any_panel_plugin(): void
    {
        self::assertSame(Hugeicon::Search02->value, FilamentIcon::resolve(PanelsIconAlias::GLOBAL_SEARCH_FIELD));
        self::assertSame(
            generate_icon_html(Hugeicon::Search02)?->toHtml(),
            generate_icon_html(null, PanelsIconAlias::GLOBAL_SEARCH_FIELD)?->toHtml(),
        );
        self::assertSame(Hugeicon::Home02->value, FilamentIcon::resolve(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM));
    }

    public function test_configuration_can_be_exported_and_loaded_with_enum_and_string_values(): void
    {
        $file = tempnam(sys_get_temp_dir(), 'hugeicons-config-');
        self::assertNotFalse($file);
        $config = config('filament-hugeicons');

        try {
            file_put_contents($file, '<?php return ' . var_export($config, true) . ';');
            self::assertSame($config, require $file);
        } finally {
            unlink($file);
        }
    }
}
