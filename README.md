# Filament Hugeicons

Use [Hugeicons Free](https://hugeicons.com/) in Filament 5 with a discoverable, string-backed PHP enum. Choose from 6,839 icons with IDE autocomplete and pass enum cases directly to Filament components.

## Installation

The upcoming release supports Filament `^5.0`. Version `0.1.0-alpha.3` below requires Filament `^5.11.2`; broad compatibility is not yet published.

In your existing Laravel / Filament 5 application, run:

```sh
composer require enigmainc/filament-hugeicons:0.1.0-alpha.3 -W
```

The `-W` option allows Composer to update locked dependencies, including Filament, to compatible versions. If your application's `composer.json` pins Filament to an older version, update that constraint too:

```sh
composer require enigmainc/filament-hugeicons:0.1.0-alpha.3 'filament/filament:^5.0' -W
```

The explicit version installs the alpha without changing your application's `minimum-stability`. Laravel discovers the package and its Blade Icons dependency automatically. No panel plugin registration, config publishing, or asset build is required.

### Requirements

- PHP 8.2 or later within PHP 8.x.
- Filament 5 (`^5.0`). Filament 4 is unsupported.
- Laravel 12 is the tested Laravel version.

Composer installs these package dependencies automatically:

| Dependency | Version |
| --- | --- |
| `filament/filament` | `^5.0` |
| `spatie/laravel-package-tools` | `^1.16` |
| `afatmustafa/blade-hugeicons` | `2.1.0` |

Blade Hugeicons supplies the free SVGs through Blade Icons. Keep its default `hugeicons` prefix; changing `blade-hugeicons.prefix` breaks the enum identifiers.

## Usage

Import the enum wherever you define your Filament components:

```php
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
```

Pass an enum case directly to the icon method. You do not need `->value` for the Filament APIs shown below.

### Actions

```php
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\Actions\Action;

Action::make('edit')
    ->icon(Hugeicon::PencilEdit01);
```

### Form fields

```php
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\Forms\Components\TextInput;

TextInput::make('search')
    ->prefixIcon(Hugeicon::Search01);
```

### Table columns

```php
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\Tables\Columns\IconColumn;

IconColumn::make('active')
    ->boolean()
    ->trueIcon(Hugeicon::CheckmarkCircle01);
```

### Navigation items

```php
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\Navigation\NavigationItem;

NavigationItem::make('Home')
    ->icon(Hugeicon::Home01);
```

### Finding icons

Type `Hugeicon::` in your IDE to browse the available cases, or browse the [enum catalog for this release](https://github.com/pitatumisang/filament-hugeicons/blob/v0.1.0-alpha.3/src/Icons/Hugeicon.php).

Case names are case-sensitive and preserve filename word boundaries: `PlayList` and `Playlist` are different icons. If another API requires a string, use the backing value, for example `Hugeicon::Home01->value` returns `hugeicons-home-01`.

## Optional default icon replacement

Enable curated Hugeicons defaults in a panel provider:

```php
use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\View\PanelsIconAlias;

$panel->plugin(
    FilamentHugeiconsPlugin::make()
        ->replaceDefaultIcons()
        ->overrideAliases([
            PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02,
        ])
);
```

Replacement covers 81 of the 221 canonical aliases inspected in Filament 5.11.2. Unmapped aliases retain Filament's originals. Native developer icon registrations take priority, followed by fluent overrides, config overrides, and bundled mappings. Use Filament's native alias constants for overrides. On older Filament releases, different alias spellings are distinct keys; releases with native alias normalization follow that behavior.

**Replacement applies application-wide, including panels without the plugin.** All plugin declarations must agree; conflicting declarations throw a `LogicException`. Per-panel and per-tenant policies are unsupported. Restart long-running workers after policy changes.

### Configuration without a panel plugin

Publish the config file:

```sh
php artisan vendor:publish --tag=filament-hugeicons-config
```

In `config/filament-hugeicons.php`, enable replacement and optionally supply overrides:

```php
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\View\PanelsIconAlias;

return [
    'replace_default_icons' => true,
    'overrides' => [
        PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02,
    ],
];
```

Replacement is disabled by default. The fluent `replaceDefaultIcons()` flag takes precedence over config. Overrides alone do not enable replacement. Override keys must be nonempty alias strings; values must be `Hugeicon` cases or registered Blade Icons identifiers.
