<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Tests\Feature;

use BladeUI\Icons\Factory;
use Composer\InstalledVersions;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use EnigmaInc\FilamentHugeicons\Tests\TestCase;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Navigation\NavigationItem;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Filesystem\Filesystem;

use function Filament\Support\generate_icon_html;

final class IconCatalogTest extends TestCase
{
    public function test_every_enum_case_matches_and_resolves_its_real_svg_without_fallback(): void
    {
        config()->set('blade-icons.fallback', '');
        config()->set('blade-hugeicons.fallback', '');
        $factory = app(Factory::class);
        $directory = InstalledVersions::getInstallPath('afatmustafa/blade-hugeicons') . '/resources/svg';
        $files = glob($directory . '/*.svg') ?: [];
        $expected = array_map(static fn (string $file): string => 'hugeicons-' . basename($file, '.svg'), $files);
        $values = array_column(Hugeicon::cases(), 'value');
        sort($expected);
        sort($values);

        self::assertNotEmpty($expected);
        self::assertSame($expected, $values);
        self::assertCount(count($values), array_unique($values));

        foreach (Hugeicon::cases() as $icon) {
            $source = app(Filesystem::class)->get($directory . '/' . substr($icon->value, strlen('hugeicons-')) . '.svg');
            self::assertXmlStringEqualsXmlString($source, $factory->svg($icon->value)->contents(), $icon->name);
        }
    }

    public function test_action_accepts_and_renders_an_enum_case_directly(): void
    {
        $action = Action::make('edit')->icon(Hugeicon::PencilEdit01);
        self::assertSame(Hugeicon::PencilEdit01, $action->getIcon());
        $this->assertRenderedSvg(Hugeicon::PencilEdit01, generate_icon_html($action->getIcon())?->toHtml() ?? '');
    }

    public function test_form_prefix_accepts_and_renders_an_enum_case_directly(): void
    {
        $input = TextInput::make('search')->prefixIcon(Hugeicon::Search01);
        self::assertSame(Hugeicon::Search01, $input->getPrefixIcon());
        $this->assertRenderedSvg(Hugeicon::Search01, generate_icon_html($input->getPrefixIcon())?->toHtml() ?? '');
    }

    public function test_boolean_column_accepts_and_renders_an_enum_case_directly(): void
    {
        $column = IconColumn::make('active')->boolean()->trueIcon(Hugeicon::CheckmarkCircle01);
        self::assertSame(Hugeicon::CheckmarkCircle01, $column->getIcon(true));
        $this->assertRenderedSvg(Hugeicon::CheckmarkCircle01, generate_icon_html($column->getIcon(true))?->toHtml() ?? '');
    }

    public function test_navigation_accepts_and_renders_an_enum_case_directly(): void
    {
        $item = NavigationItem::make('Home')->icon(Hugeicon::Home01);
        self::assertSame(Hugeicon::Home01, $item->getIcon());
        $this->assertRenderedSvg(Hugeicon::Home01, generate_icon_html($item->getIcon())?->toHtml() ?? '');
    }

    private function assertRenderedSvg(Hugeicon $icon, string $html): void
    {
        self::assertStringContainsString('<svg', $html);
        self::assertStringContainsString('fi-icon', $html);
        self::assertSame(
            preg_replace('/<svg[^>]*>/', '<svg>', app(Factory::class)->svg($icon->value)->contents()),
            preg_replace('/<svg[^>]*>/', '<svg>', $html),
        );
    }
}
