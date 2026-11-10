# Official skeleton comparison

Compared the local scaffold with `filamentphp/plugin-skeleton` branch `5.x`,
commit `820e4ead635a9c15ce59f767c9d0951282f5b388`, on 2026-11-10.
The local project was manually assembled; this comparison does not claim full
upstream parity or completion of architecture Phase 0.

## Adopted and adapted

- Retained the native Filament `Plugin` and Spatie `PackageServiceProvider` patterns.
- Added the upstream configure script, EditorConfig, and export attributes.
  The configure script remains a template reference and has not been run over this
  already-named scaffold; the user has selected `enigmainc/filament-hugeicons` and `EnigmaInc\FilamentHugeicons`.
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
  are needed for these tests. Added the upstream-style Orchestra Testbench base class, scoped to feature tests. Dependency discovery is enabled; the root package provider is explicitly registered as in the official skeleton. Five feature tests verify provider booting without a panel plugin, disabled config defaults, config publishing, untouched fallback aliases, and preservation of an existing alias when replacement is disabled. A separate minimal Laravel 12 consuming application has also verified provider auto-discovery through a local Composer path installation.

## Intentional differences and remaining work

- Configured CI targets PHP 8.2–8.4 / Laravel 12, matching Testbench `^10.0`.
  The wider upstream Laravel/OS/lowest-version matrix remains unverified.
- Formatting fails CI instead of automatically committing changes.
- Kept package/provider class names and applied the user-selected `EnigmaInc\FilamentHugeicons` namespace and `enigmainc/filament-hugeicons` Composer name.
- Omitted skeleton commands, migrations, models, assets, views, facades, and
  browser tooling because this package’s product contract does not need them.
- Phase 1 now pins the icon dependency to `2.1.0`, generates and validates all 6,839 enum cases, and verifies native icon rendering. Alias replacement and panel isolation remain Phase 2 work.

## Foundation verification

On PHP 8.4, `composer check` passes: 14 tests, 32 assertions; PHPStan max
analyzes 10 files with no errors; Pint and Rector report no changes required.
Publisher identity is `enigmainc/filament-hugeicons` / `EnigmaInc\FilamentHugeicons`.
A separate temporary Laravel 12.71.0 / Filament 5.11.2 application installed the
working package using a Composer path repository, with no package development
dependencies. Booting its console kernel auto-discovered this package’s provider
and the Blade Hugeicons provider, and loaded disabled replacement / empty override
defaults without any panel registration. This is a local source installation
check, not a Packagist publication or remote CI result.

## Phase 1 verification

The public enum contains 6,839 cases generated from Blade Hugeicons 2.1.0, with a
source manifest and per-SVG hashes. All cases match their registered source SVGs
with fallbacks disabled. Action, TextInput prefix, IconColumn boolean, and
NavigationItem APIs accept cases directly; Filament's native helper renders them.
A separate Laravel 12 consuming app also renders Home01 without panel setup or
package development autoloading. Local PHP 8.4 checks pass: 31 tests, 6,925
assertions; PHPStan max analyzes 14 files; Pint, Rector, and drift checks pass.
Independent review found no material defects. Generic Composer constraint advice
is disabled during strict metadata validation because the exact catalog pin is
intentional; PHPStan has no baseline or suppressions. Remote CI remains unverified.
