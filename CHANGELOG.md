# Changelog

## 0.1.0-alpha.3 — 2026-11-10

### Added

- Opt-in application-wide default icon replacement for 81 canonical Filament aliases, preserving originals for unmapped aliases.
- Fluent `overrideAliases()` and config overrides, with native developer registrations taking highest priority.
- Bootstrap policy validation, conflicting panel declaration guards, and registry reset replay coverage.
- Deterministic mapped/unmapped alias coverage report and CI drift check.

### Changed

- Require Filament `^5.11.2` for its verified native alias-normalization API.
- Update installation and usage documentation for the replacement feature and its application-wide scope.

### Limitations

- Per-panel, per-request, and per-tenant replacement policies are unsupported. Restart long-running workers after configuration changes; a real Octane server remains untested.
- Public APIs and catalog identifiers may change before v1.0.0.

## 0.1.0-alpha.1 / 0.1.0-alpha.2 — enum-only releases

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
- Filament 4 is unsupported. These releases were published separately from the replacement implementation; see the historical release checklist.
- Enum names, backing values, and public APIs may change before v1.0.0. Keep the Blade Hugeicons default prefix.
