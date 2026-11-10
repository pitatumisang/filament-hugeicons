# Filament Hugeicons

Use [Hugeicons Free](https://hugeicons.com/) in Filament 5 with a discoverable, string-backed PHP enum. Choose from 6,839 icons with IDE autocomplete and pass enum cases directly to Filament components.

[Packagist](https://packagist.org/packages/enigmainc/filament-hugeicons) · [Alpha release](https://github.com/pitatumisang/filament-hugeicons/releases/tag/v0.1.0-alpha.2)

## Installation

In your existing Laravel / Filament 5 application, run:

```sh
composer require enigmainc/filament-hugeicons:0.1.0-alpha.2
```

The explicit version installs the alpha without changing your application's `minimum-stability`. Laravel discovers the package and its Blade Icons dependency automatically. No panel plugin registration, config publishing, or asset build is required.

### Requirements

- PHP 8.2 or later within PHP 8.x.
- Filament 5 (`^5.0` in the published alpha). Filament 4 is unsupported.
- Laravel 12 is the tested Laravel version.

The alpha passed CI on PHP 8.2, 8.3, and 8.4 with Laravel 12. Installation from Packagist and native icon rendering were also verified in a separate Laravel 12 application.

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

Type `Hugeicon::` in your IDE to browse the available cases, or browse the [enum catalog for this release](https://github.com/pitatumisang/filament-hugeicons/blob/v0.1.0-alpha.2/src/Icons/Hugeicon.php).

Case names are case-sensitive and preserve filename word boundaries: `PlayList` and `Playlist` are different icons. If another API requires a string, use the backing value, for example `Hugeicon::Home01->value` returns `hugeicons-home-01`.

## Alpha scope

This README describes the published **v0.1.0-alpha.2** release. Its public API and icon catalog may change before v1.0.0.

The alpha supports explicit icon selection through the enum. It leaves Filament's default icons unchanged. Automatic default icon replacement and alias overrides are excluded from this release; do not use the scaffold's `replaceDefaultIcons()` method to enable them.

The free icon catalog comes from `afatmustafa/blade-hugeicons`, pinned to `2.1.0`. Keep that dependency's default `hugeicons` prefix: changing `blade-hugeicons.prefix` breaks the enum's identifiers. Icons render locally through Blade Icons; no custom renderer or icon network requests are needed.

## Contributing

For development setup and checks, see [tests/README.md](tests/README.md). The [product specification](PRODUCT.md), [architecture](ARCHITECTURE.md), and [skeleton reconciliation notes](docs/upstream-skeleton.md) describe the implementation and planned work; unreleased features are outside the alpha usage documented here.

## License

[MIT](LICENSE). The Blade wrapper and Hugeicons Free source are also MIT licensed; see [third-party notices](THIRD_PARTY_NOTICES.md). Hugeicons Pro assets are not included.
