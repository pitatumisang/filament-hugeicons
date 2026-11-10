# Optional default icon replacement

This Phase 2 development branch supports replacing 81 of the 221 canonical aliases
in the inspected Filament 5.11.2 source. See the [full mapped/unmapped report](default-icon-coverage.md).
The original Phase 1 alpha release plan is separate from this branch's new behavior.

Replacement is **off by default**. Explicit `Hugeicon` usage always works without
registering a panel plugin. Unmapped aliases retain Filament's original icons.

## Application-wide scope

Replacement applies to every panel and other Filament components in the application.
Registering the plugin on one panel does not isolate its effects to that panel.
Filament shares the scoped alias registry and replays registrations when it resets.
This package does not replace that registry or clear another panel's aliases.

Declare the policy during application bootstrap. The service provider collects panel
plugin declarations, validates them, and freezes one policy after providers boot.
Panels with no plugin share that policy. Plugin declarations must agree on their
resolved enabled flag and override map; conflicting declarations fail with a
LogicException before package aliases are installed. Changing a registered plugin
is checked again at plugin boot and fails clearly. Late identical declarations are
idempotent; late incompatible declarations are rejected. Configure different icon
choices with native Filament customizations if needed; per-panel replacement and
per-request/per-tenant policy changes are unsupported. Restart long-running workers
after changing configuration. Registry reset replay is tested; a real Octane server
has not been tested.

## Global configuration

Publish the optional config file:

```sh
php artisan vendor:publish --tag=filament-hugeicons-config
```

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

No panel plugin is required for config-only replacement. The config supports enum
cases and string values and can be exported into Laravel's configuration cache.
Keep the Blade Hugeicons dependency's default `hugeicons` prefix.

## Fluent plugin configuration

In a panel provider, before application boot finishes:

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

This is an application-wide declaration. The explicit fluent flag takes precedence
over published config; an unspecified flag inherits config (false by default).
Repeated overrideAliases calls merge entries, with later values winning. If
replacement resolves to false, neither bundled mappings nor package overrides apply;
overrides alone do not enable replacement. Invalid config types still fail clearly.
Multiple plugins must resolve to the same policy, including their override maps.

## Override precedence and validation

For each alias, precedence from highest to lowest is:

1. Native developer registrations through FilamentIcon::register or panel icons,
   whether registered before or after the package.
2. Fluent overrides.
3. Published config overrides.
4. Bundled curated mappings.
5. Filament's original fallback for unmapped aliases.

Keys must be nonempty alias strings. Aliases are canonicalized using Filament’s native normalizer before merging and policy comparison. This branch requires Filament `^5.11.2` to ensure the verified normalization API is available. Values must be Hugeicon cases or nonempty
registered Blade Icons identifiers. Native markup/Htmlable customizations continue
working through Filament's own API, which has priority over package mappings.
Custom string icons use Blade Icons' native resolution and any application-configured
fallback. With default fallbacks disabled, missing icons fail with an actionable
exception naming the alias. The complete small mapping is validated before any of
its entries are written to a scoped registry. The package performs no SVG catalog
scan at runtime and does not install callbacks on each panel boot.

## Coverage maintenance

```sh
composer icons:coverage       # Regenerate the full mapped/unmapped report
composer icons:coverage:check # Check report drift without writing
composer check               # Includes coverage and catalog checks
```

Coverage is tied to the installed Filament version; updating Filament may require
regenerating and reviewing the report, even if mapping counts are unchanged.
Production mappings use native constants, with no runtime reflection. All mapped constants were also found in upstream v5.0.0 source, but the policy requires
the native alias-normalization API verified in Filament 5.11.2; Composer therefore
requires `^5.11.2`. Runtime verification covers PHP 8.4, Laravel 12, and Filament
5.11.2. The full worker and PHP compatibility matrix remains unverified.
