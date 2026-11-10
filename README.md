# Filament Hugeicons

A Laravel package in development that aims to make Hugeicons Free feel native to Filament 5 through a discoverable `Hugeicon` string-backed enum and optional replacement of Filament’s default icons.

> **Status: initial scaffold and implementation specifications.** The local starter was manually assembled. Quality tooling has now been compared with and adapted from the official Filament 5 plugin skeleton; full reconciliation remains in progress. Development dependencies are installed, but icon identifiers, component compatibility, and alias behavior have not been verified. This is not yet a release-ready package.

## Project specifications

- [PRODUCT.md](PRODUCT.md) defines the product contract, planned API, scope, and v1 acceptance checklist.
- [ARCHITECTURE.md](ARCHITECTURE.md) defines the technical blueprint, verification requirements, and implementation phases.
- [AGENTS.md](AGENTS.md) defines repository instructions for implementation work.

Read the product and architecture documents in full before changing the implementation. Examples below describe the intended API, not working functionality in the current scaffold.

## Planned usage

Explicit icon usage will work after Composer installation and Laravel package auto-discovery, without registering a panel plugin or accessing `->value`:

```php
use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;

Action::make('edit')->icon(Hugeicon::PencilEdit01);
TextInput::make('search')->prefixIcon(Hugeicon::Search01);
IconColumn::make('active')->trueIcon(Hugeicon::CheckmarkCircle01);
```

These enum case names are illustrative until validated against the chosen SVG catalog. Filament 5 is the primary target; Filament 4 support is not promised.

### Optional default icon replacement

Replacing Filament’s internal icon choices will be disabled by default and independent of explicit enum usage. The intended opt-in API is:

```php
use EnigmaInc\FilamentHugeicons\FilamentHugeiconsPlugin;

$panel->plugin(
    FilamentHugeiconsPlugin::make()->replaceDefaultIcons()
);
```

The scaffold currently exposes the flag but does not register icon mappings. The planned behavior is:

- Mapped aliases use curated Hugeicons equivalents when replacement is enabled.
- Unmapped aliases retain Filament’s original icons.
- Developer overrides take priority over bundled mappings.

An `overrideAliases([...])` API is planned, subject to verification of Filament’s supported alias and value types. Configuration and fluent-option precedence must be finalized and tested before use.

**Panel isolation is unverified.** Registering a plugin on one panel does not establish that replacements are scoped to that panel. If Filament’s registry is shared, replacement may be supported only application-wide; multi-panel behavior must be tested and documented before release.

## Architecture

The intended rendering path uses the existing Filament and Blade Icons integrations:

```text
Hugeicon enum case
    -> native Filament icon argument
    -> registered Blade Icons identifier
    -> trusted Hugeicons Free SVG
```

The enum will be generated deterministically from a pinned, verified free SVG catalog. Generation and CI must detect missing SVGs, naming collisions, duplicate values, and catalog drift. The package will not scan the entire catalog on each request, introduce a custom renderer, or override Filament views.

The implementation must adopt the actual [official plugin skeleton’s 5.x branch](https://github.com/filamentphp/plugin-skeleton/tree/5.x), including its package-tools setup, testing, quality tooling, and applicable workflows. The quality setup is adapted from upstream commit `820e4ead635a9c15ce59f767c9d0951282f5b388`; see [the reconciliation notes](docs/upstream-skeleton.md) for retained conventions and remaining differences.

## Installation status

No supported installation command or compatibility matrix is available yet. The package identity is `enigmainc/filament-hugeicons` with PHP namespace `EnigmaInc\FilamentHugeicons`. The candidate Blade Hugeicons dependency is constrained to `^2.1` (locally resolved to 2.1.0). Its registered prefix, catalog, asset licensing, and rendering compatibility still require verification before release.

PHP and Laravel support will be documented after reconciliation with the official skeleton and verification against installed Filament 5 dependencies. Do not treat the scaffold’s Composer constraints as a tested support matrix.

## Implementation roadmap

1. **Foundation:** compare and reconcile the scaffold with the official 5.x skeleton, confirm the publisher namespace, resolve dependencies, and run baseline checks.
2. **Catalog and integration:** select a compatible Blade Icons source, generate the public enum, validate every case, and prove direct use in representative Filament 5 components without panel registration.
3. **Optional replacement:** inspect real Filament aliases and registry behavior, implement curated mappings and override precedence, and test fallback and multi-panel behavior.
4. **Release readiness:** complete the acceptance checklist in [PRODUCT.md](PRODUCT.md), verify supported versions and licensing, and document tested installation and usage.

## Validation

Install development dependencies with `composer install`, then run:

```sh
composer check          # All checks below; does not modify files
composer analyse        # PHPStan max (currently level 10), with Larastan
composer test:lint      # Pint formatting check, including strict_types
composer test:refactor  # Rector modernization check
composer test:arch      # Pest architecture rules
composer test           # Full test suite
```

To apply changes, use `composer refactor` followed by `composer lint` (`composer format` is also available). Rector derives its PHP language target from Composer’s minimum supported version, currently PHP 8.2, rather than the developer’s local runtime. It enables dead-code, code-quality, type-declaration, privatization, and early-return sets.

PHPStan analyzes `src`, `config`, and `tests` at `max`, with no baseline or error suppressions. Architecture tests enforce strict types, the string-backed enum contract, icon independence from panel/container setup, native plugin/provider contracts, and restrictions on debugging, test tooling, and database dependencies in production code.

The GitHub Actions quality job runs these checks on PHP 8.2–8.4 with Laravel 12. Local verification covers PHP 8.4 only; remote CI results are not yet available. The current suite proves scaffold architecture and Laravel provider/config boot behavior, including preservation of existing aliases with replacement disabled. A separate local Laravel 12 application also verified Composer path installation and provider auto-discovery without panel setup. Icon rendering and enabled replacement remain unverified. Every generated enum case must later resolve to a real registered SVG, with integration tests for native enum usage, opt-in replacement, fallback, overrides, and multi-panel limitations.

## Licensing and scope

The scaffold is licensed under [MIT](LICENSE). The selected icon dependency’s license and attribution requirements still need verification. Only Hugeicons Free assets are in scope; Hugeicons Pro assets will not be bundled. An icon picker, custom SVG renderer, and Filament view forks are outside v1 scope.
