# Filament Hugeicons — Technical Architecture

> Publisher selected on 2026-11-10: Composer `enigmainc/filament-hugeicons`, PHP namespace `EnigmaInc\FilamentHugeicons`. Earlier `Vendor` examples below are illustrative placeholders; implementation and README use the selected identity.

> Status: implementation blueprint, 2026-11-10. Agreed design is normative; APIs/dependency details marked **VERIFY** must be checked against installed upstream code. This is not a claim that the existing local starter is an official skeleton clone.

> Compatibility update: the current implementation targets Filament `^5.0` and PHP `^8.2`. Use native alias normalization where available; older registries preserve exact alias strings. Alpha.3 remains pinned to its original `^5.11.2` requirement. Replacement is application-wide and disabled by default; see `docs/default-icon-replacement.md` for finalized precedence, lifecycle, and limitations. Earlier proposed options below are retained as design history.

## 1. Architectural principles

1. **Official skeleton first:** initialize/reconcile against `filamentphp/plugin-skeleton` branch `5.x`; do not maintain a hand-invented alternative to skeleton conventions.
2. **Native icon flow:** `Hugeicon` backed enum -> Filament icon argument -> Blade Icons name resolution -> SVG output.
3. **Two independent features:** explicit enum usage is available on package installation; replacement of Filament's own aliases is optional.
4. **Minimal integration:** no custom Blade components, asset publishing, JavaScript, database, or runtime SVG parsing unless upstream integration genuinely requires it.
5. **Generated catalog:** enum values and manifest derive from one pinned SVG source; never hand-maintain thousands of cases.
6. **Safe fallback:** leave unmapped Filament aliases untouched.
7. **Verified scope:** do not promise panel isolation if icon alias registry is process/application-wide.

## 2. Repository baseline

**Source of truth:** https://github.com/filamentphp/plugin-skeleton/tree/5.x

Use GitHub's **Use this template** or clone the branch, then run the skeleton's `configure.php` as documented upstream. Retain its Composer metadata conventions, Spatie Laravel Package Tools provider, plugin class contract, tests, CI, Pint, PHPStan/Larastan, Rector and release workflows where applicable. Delete only clearly unused example features.

**Existing local starter warning:** `/mnt/data/Sandbox/filament-hugeicons` was previously created as a manually assembled scaffold because GitHub was not reachable in that environment. It is **not verified to match the official skeleton**. Codex must compare it to the actual `5.x` branch and reconcile before adding implementation. The current `vendor/filament-hugeicons` name and `Vendor\\FilamentHugeicons` namespace are placeholders.

### Intended structure (adapt the actual skeleton, not vice versa)

```text
filament-hugeicons/
├── .github/                         # official skeleton workflows
├── bin/                             # retain if present upstream
├── config/
│   └── filament-hugeicons.php
├── resources/
│   └── icon-manifest.json            # generated, if useful
├── src/
│   ├── Icons/
│   │   └── Hugeicon.php              # generated string-backed enum
│   ├── Mappings/
│   │   └── DefaultIconMappings.php   # verified Filament 5 alias map
│   ├── Support/
│   │   └── IconMappingRegistry.php    # merges/validates mappings
│   ├── FilamentHugeicons.php          # only if justified by skeleton pattern
│   ├── FilamentHugeiconsPlugin.php
│   └── FilamentHugeiconsServiceProvider.php
├── scripts/                          # deterministic generator, if needed
├── tests/
│   ├── Unit/
│   └── Feature/
├── composer.json
├── configure.php                     # official skeleton configuration tool
├── phpstan.neon.dist
├── phpunit.xml.dist
├── pint.json
├── rector.php
├── README.md
├── PRODUCT.md
├── ARCHITECTURE.md
└── AGENTS.md
```

Avoid unnecessary empty abstraction layers. Prefer a small service or pure mapper only if it improves testability.

## 3. Composer dependencies

- Supported Filament major: `filament/filament: ^5.0`; PHP `^8.2`. Laravel 12 is the tested Laravel version. Minimum, regression, latest, and pinned reference report lanes validate compatibility.
- Spatie `laravel-package-tools`: use the version and setup from the actual official 5.x skeleton.
- Blade Icons Hugeicons source: **candidate** `afatmustafa/blade-hugeicons`; alternative `anodyne/blade-hugeicons`. **VERIFY** licenses, maintenance, registered collection prefix, SVG filenames, supported versions, install side effects, and whether its own enum is sufficient.
- Testing: preserve official skeleton's Pest, Orchestra Testbench, Laravel Pint, PHPStan/Larastan and related tools.
- Never ship `"*"` as the final Hugeicons dependency constraint. Pin compatible major/minor ranges after validation.
- Replace placeholder Composer vendor and PHP namespace only after publisher identity is chosen.

## 4. Icon resolution and enum

### Runtime path

```text
Filament component -> Hugeicon::SomeCase
  -> string-backed enum value (registered Blade Icons identifier)
  -> Filament's existing icon handling
  -> Blade Icons registry
  -> trusted Hugeicons Free SVG
  -> inline SVG markup
```

### Example generated enum (illustrative)

```php
<?php

namespace Vendor\FilamentHugeicons\Icons;

enum Hugeicon: string
{
    case Home01 = 'hugeicons-home-01';
    case Search01 = 'hugeicons-search-01';
}
```

**VERIFY** these values against the selected package. The exact prefix may differ. The generator must derive values from real registered icon names; don't assume the prefix.

### Generator contract

Input: installed, version-locked Hugeicons Free SVG catalog (or authoritative manifest from that same package).

Output: `src/Icons/Hugeicon.php` and optional `resources/icon-manifest.json`.

Rules:

1. Sort input deterministically; normalize filenames to valid PascalCase PHP enum cases.
2. Ensure cases are unique, including numeric-leading and acronym collisions.
3. Backing values must be the actual registered Blade Icons identifiers.
4. Fail loudly on collisions, empty catalog, invalid names, missing SVGs or duplicate values.
5. Preserve stable mappings across regeneration where possible; breaking renames require changelog/version review.
6. Provide `--check` or equivalent CI mode that reports generated-file drift without changing files.
7. Never load/scan the entire icon directory on every web request.

Before implementing the generator, evaluate whether the selected upstream package already provides a suitable enum. Avoid needless duplication, but preserve the agreed `Hugeicon::Name` public API.

## 5. Service provider

Follow the actual skeleton's `Spatie\LaravelPackageTools\PackageServiceProvider` pattern, e.g.:

```php
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentHugeiconsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-hugeicons')->hasConfigFile();
    }
}
```

This is illustrative; align with the exact skeleton. The Blade dependency should register its own icon collection. Do not register it twice. Ensure explicit enum use works after Composer/Laravel package auto-discovery, with no panel plugin registration.

## 6. Filament plugin and default replacement

### Public contract

```php
FilamentHugeiconsPlugin::make()
    ->replaceDefaultIcons();
```

Potential customization:

```php
FilamentHugeiconsPlugin::make()
    ->replaceDefaultIcons()
    ->overrideAliases([
        // verified Filament alias key => Hugeicon case / icon name
    ]);
```

### Lifecycle

- Implement the official Filament 5 `Filament\Contracts\Plugin` interface and skeleton conventions.
- `register(Panel $panel)` handles only registration that belongs there.
- `boot(Panel $panel)` can apply aliases only if upstream lifecycle and registry scope make it safe.
- Use Filament's supported `FilamentIcon::register([...])` API **after VERIFYING current signatures and alias constants**.
- Use official Filament alias constants/enums where possible; do not hardcode guessed keys.

### Mapping resolution

```text
Filament's original alias (implicit fallback)
       < bundled Hugeicons default map (when enabled)
       < developer custom overrides (highest precedence)
```

Resolve aliases to valid registered icon identifiers. If an alias lacks a suitable match, omit it from registration, preserving Filament's original icon. Test the merge order. The actual alias key types may be enum or string; normalize only as supported by Filament.

### Multi-panel warning

Filament's icon alias registry may be shared at application scope. Panel-local plugin registration does not prove panel-local icon overrides. Investigate implementation, request lifecycle and long-running workers (e.g., Octane). If isolation cannot be guaranteed, explicitly support application-wide replacement only, prevent conflicting per-panel settings where feasible, and document the limitation. Do not silently leak mappings between panels.

## 7. Configuration

Proposed starting config:

```php
return [
    'replace_default_icons' => false,
    'overrides' => [],
];
```

Decision to finalize during implementation: exact relationship between global config and fluent plugin API. Suggested precedence is explicit fluent option > published config > false, but only if implementable without ambiguous panel behavior. Keep config opt-in by default and do not require publishing for normal use.

## 8. Test strategy

### Unit

- Every enum case has a unique valid backing value.
- Every enum case resolves to an SVG in the selected installed collection.
- Generator is deterministic and detects collisions/drift.
- Alias map contains valid keys and valid icon values.
- Override precedence and unmapped fallback are correct.

### Integration / Feature

- Package service provider is auto-discovered and registers no duplicate icon collection.
- `Action::icon(Hugeicon::...)` works without `->value`.
- Representative navigation, form prefix icons, table icons, and other Filament 5 components accept the enum.
- Default replacement disabled leaves native Filament aliases untouched.
- Default replacement enabled changes mapped aliases only.
- User overrides win.
- Multi-panel tests detect registry leakage; if unsupported, document and guard.
- Rendering works with production caches / long-running application assumptions where feasible.

### Quality and CI

Run the **actual skeleton's** commands for Pest, PHPStan/Larastan, Pint and Rector checks. Keep compatibility matrix aligned with the chosen Filament 5 PHP/Laravel versions. No claim of passing tests until dependencies are installed and commands actually run.

## 9. Implementation plan for Codex

### Phase 0 — Reconcile scaffold (mandatory)

1. Inspect `PRODUCT.md`, `ARCHITECTURE.md`, `AGENTS.md`.
2. Fetch/inspect official `filamentphp/plugin-skeleton` **5.x** branch.
3. Compare local scaffold against upstream, including Composer, providers, plugin class, configure script, CI and tests.
4. Adopt official skeleton conventions; preserve these specification documents.
5. Replace placeholder namespace/vendor after confirming desired publisher.
6. Install Composer dependencies and run skeleton baseline tests; report any environment blockers.

### Phase 1 — Icon catalog

1. Evaluate the candidate Blade Hugeicons packages and record the choice, license, prefix and pinned version.
2. Implement generator or reuse a suitable upstream enum through an intentional adapter.
3. Generate `Hugeicon` and manifest; add drift and existence tests.
4. Verify direct icon rendering with Filament 5.

### Phase 2 — Optional replacement

1. Inspect Filament 5 alias declarations and `FilamentIcon` registry.
2. Create curated mapping for aliases with sensible Hugeicons equivalents.
3. Implement opt-in flag and override merge logic.
4. Test fallback, override precedence and multi-panel behavior.

### Phase 3 — Production readiness

1. README with installation, usage, examples and caveats.
2. CI, static analysis, formatting, release workflow and licensing checks.
3. Test supported PHP/Laravel versions and build release artifacts.

## 10. Explicit non-goals and anti-patterns

- Do not build a custom icon rendering engine.
- Do not replace Filament Blade templates to change icons.
- Do not bundle Hugeicons Pro assets.
- Do not silently enable global replacement on installation.
- Do not promise Filament 4 support until tested.
- Do not hardcode a guessed icon catalog or alias list.
- Do not use `*` dependency constraints in a release.
- Do not create empty service classes merely to match a speculative tree.
- Do not claim the manually created local starter is identical to the official skeleton.

## 11. Reference links

- Official skeleton: https://github.com/filamentphp/plugin-skeleton/tree/5.x
- Filament docs: https://filamentphp.com/docs
- Hugeicons docs: https://hugeicons.com/docs
- Blade Icons: https://github.com/blade-ui-kit/blade-icons
- Candidate: https://github.com/afatmustafa/blade-hugeicons
- Alternative: https://github.com/anodyne/blade-hugeicons
- Prior art: https://github.com/filafly/filament-hugeicons-icons
