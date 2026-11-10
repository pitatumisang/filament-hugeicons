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
late mutation guards, callback stability, scoped registry replay, and legacy alias
canonicalization. Mapped SVGs and the 81/221 alias coverage report are checked.
The config export unit check is supplemented by a separate consuming application's
real Laravel config:cache/restart verification, recorded in the Phase 2 plan.
