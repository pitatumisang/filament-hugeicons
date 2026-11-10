# Icon generation

Run `composer icons:generate` after installing the exact pinned Blade Hugeicons dependency.
Run `composer icons:check` to validate both generated files without writes. This command
is part of `composer check` and CI. Unknown CLI flags and invalid catalogs fail nonzero.

The development-only generator is autoloaded only through Composer autoload-dev and
is never invoked by the package service provider. It reads the installed default prefix,
version, and source reference; the manifest also records each SVG's SHA-256.

For a source update, deliberately update Composer's exact constraint and the expected
source version in the generator; regenerate and review enum/manifest differences. Keep
the default `hugeicons` prefix. Run tests, Pint, Rector, PHPStan, and the drift check.
