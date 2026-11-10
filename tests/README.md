# Tests

Run `composer test` for all tests or `composer test:arch` for architecture rules.
The architecture suite enforces strict types, the string-backed enum contract,
icon independence from panel setup, native plugin/provider contracts, and the
absence of debugging, test-tooling, or database dependencies in production code.

Feature tests use the official skeleton’s Testbench pattern to boot the package
provider without a panel plugin and check default config, config publishing,
unmapped aliases, and preservation of existing aliases with replacement disabled.
The root provider is explicitly registered in the test harness; a separate local Laravel 12 application has also verified consuming-app auto-discovery through a Composer path installation (see `docs/upstream-skeleton.md`).

Enabled replacement is tested in Phase 2 with application-wide scope; panel-local replacement remains unsupported.

Catalog tests compare every enum case with the pinned source catalog and resolve each
SVG through Blade Icons with fallbacks disabled. Component tests pass enum cases to
native Filament APIs and compare the native icon helper’s SVG output. Generator tests
cover stable ordering, word boundaries, numeric names, collisions, malformed/empty
inputs, unreadable/missing files, version/prefix validation, and read-only drift checks.

Phase 2 tests cover application-wide config/fluent replacement, native overrides,
unmapped fallback, config serialization, plugin bootstrap, conflicting declarations,
late mutation guards, callback stability, scoped registry replay, and installed-version alias semantics. Mapped SVGs are checked against the installed upstream alias inventory. The committed 81/221 report is pinned to Filament 5.11.2; compatibility lanes validate their own inventories without rewriting it.
The config export unit check is supplemented by a separate consuming application's
real Laravel config:cache/restart verification, recorded in the Phase 2 plan.


## Filament 5 compatibility

The workflow tests exact 5.0.0 and latest 5.x on PHP 8.2–8.4 / Laravel 12,
plus 5.10.1 regression and 5.11.2 reference-report lanes on PHP 8.4.
`composer check` validates installed alias mappings and compares the committed
report when running on 5.11.2. `composer icons:coverage:reference:check` explicitly
requires 5.11.2 and rejects other versions. Regenerating the reference report also
requires 5.11.2; CI never rewrites it before checking.

Filament 5.0.0 has published security advisories and Composer blocks it by default.
Only historical compatibility jobs disable advisory blocking through a job-local
`COMPOSER_NO_SECURITY_BLOCKING=1`; current-version jobs retain blocking. This proves
API compatibility, not that deploying historical versions is advisable. No consumer
Composer configuration is weakened by the package.

See [compatibility evidence](../docs/filament-5-compatibility.md) for local results.
