# Tests

Run `composer test` for all tests or `composer test:arch` for architecture rules.
The architecture suite enforces strict types, the string-backed enum contract,
icon independence from panel setup, native plugin/provider contracts, and the
absence of debugging, test-tooling, or database dependencies in production code.

Feature tests use the official skeleton’s Testbench pattern to boot the package
provider without a panel plugin and check default config, config publishing,
unmapped aliases, and preservation of existing aliases with replacement disabled.
The root provider is explicitly registered in the test harness; a separate local Laravel 12 application has also verified consuming-app auto-discovery through a Composer path installation (see `docs/upstream-skeleton.md`).

These checks do not prove catalog completeness, rendering, alias replacement,
or panel isolation. Those integration tests belong to later implementation phases.
