# Changelog

## 0.1.0-alpha.2 — 2026-11-10

- Rewrite the README around Packagist installation and verified action, form, table, and navigation usage.
- Document supported versions, icon discovery, and alpha limitations.
- Documentation-only release; runtime code and dependencies are unchanged from alpha.1.

## 0.1.0-alpha.1 — 2026-11-10

### Added

- Public `EnigmaInc\FilamentHugeicons\Icons\Hugeicon` string-backed enum with 6,839 cases generated from Blade Hugeicons 2.1.0.
- Direct Filament 5 action, form, table, and navigation icon usage without `->value` or panel plugin setup.
- Laravel provider auto-discovery and native Blade Icons rendering.
- Deterministic catalog generation, manifest hashes, and drift validation.
- Pest, PHPStan/Larastan, Pint, Rector, and PHP 8.2–8.4 / Laravel 12 CI configuration adapted from the official Filament 5 skeleton.
- MIT licensing and third-party attribution for the free icon source.

### Alpha limitations

- Default icon replacement is excluded. The retained skeleton’s `replaceDefaultIcons()` flag applies no mappings; `overrideAliases()` is unavailable.
- Replacement fallback, override precedence, and multi-panel behavior remain unverified.
- Filament 4 is unsupported. PHP 8.2–8.4 / Laravel 12 passed the remote compatibility matrix.
- Enum names, backing values, and public APIs may change before v1.0.0. Keep the Blade Hugeicons default prefix.
