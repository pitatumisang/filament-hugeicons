# Changelog

## 0.1.0-alpha.4 — 2026-11-10

### Changed

- Support Filament `^5.0`, including applications locked to 5.10.1, instead of requiring `^5.11.2`. Applies to explicit enum usage and optional default icon replacement. Filament 4 remains unsupported.
- Retain PHP `^8.2`, matching Filament 5's minimum; PHP 8.3 is not required.
- Follow installed Filament alias semantics: native normalization when available, exact alias strings otherwise. Native overrides and unmapped fallback retain their priority.
- Separate installed alias validation from the pinned Filament 5.11.2 report drift check.

### Verified

- Pass minimum/latest Filament CI on PHP 8.2, 8.3, and 8.4 with Laravel 12, plus exact 5.10.1 regression and 5.11.2 reference-report lanes.
- Install the candidate in isolated Laravel 12 consumers locked to Filament 5.0.0 and 5.10.1 without updating existing locked dependencies; verify enum rendering, replacement, fallback, and overrides.

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
