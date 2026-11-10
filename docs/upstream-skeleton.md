# Official skeleton comparison

Compared the local scaffold with `filamentphp/plugin-skeleton` branch `5.x`,
commit `820e4ead635a9c15ce59f767c9d0951282f5b388`, on 2026-11-10.
The local project was manually assembled; this comparison does not claim full
upstream parity or completion of architecture Phase 0.

## Adopted and adapted

- Retained the native Filament `Plugin` and Spatie `PackageServiceProvider` patterns.
- Added the upstream configure script, EditorConfig, and export attributes.
  The configure script remains a template reference and has not been run over this
  already-named scaffold; publication still needs the user’s publisher identity.
- Adopted upstream Composer command names and Testbench package discovery.
- Added explicit Rector and Pest architecture/Laravel plugin dependencies.
- Based Rector configuration on the upstream prepared sets and `withPhpSets()`.
  Omitted `strictBooleans`: upstream names it, but Rector 2.8.4 does not accept it.
- Adopted upstream Pint rules and added mandatory `declare(strict_types=1)`.
- Raised PHPStan to `max`, explicitly loaded Larastan/Carbon extensions, enabled
  upstream Octane/model checks, and included source, config, and test files.
  There is no baseline or suppression list.
- Adapted upstream read-only CI jobs into one quality matrix; preserved the
  upstream changelog and workflow-security workflows and pinned action references.
- Used Pest for architecture checks; no database setup or unused example features
  are needed for these tests. Full integration Testbench setup remains future work.

## Intentional differences and remaining work

- Configured CI targets PHP 8.2–8.4 / Laravel 12, matching Testbench `^10.0`.
  The wider upstream Laravel/OS/lowest-version matrix remains unverified.
- Formatting fails CI instead of automatically committing changes.
- Kept existing package/provider names and placeholder publisher namespace.
- Omitted skeleton commands, migrations, models, assets, views, facades, and
  browser tooling because this package’s product contract does not need them.
- The icon source dependency is constrained to `^2.1`; catalog/license validation,
  enum generation, rendering, aliases, and panel isolation remain unimplemented.
