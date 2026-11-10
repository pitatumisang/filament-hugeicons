# Tests

Run `composer test` for all tests or `composer test:arch` for architecture rules.
The architecture suite enforces strict types, the string-backed enum contract,
icon independence from panel setup, native plugin/provider contracts, and the
absence of debugging, test-tooling, or database dependencies in production code.

These checks do not prove catalog completeness, rendering, alias replacement,
or panel isolation. Those integration tests belong to later implementation phases.
