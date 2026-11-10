# Filament 5 Compatibility Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans for native execution or superpowers:subagent-driven-development if selected by the user. Implement task-by-task; preserve unrelated changes.

**Goal:** Support Filament ^5.0, including locked 5.10.1 applications, without changing the package's public icon APIs.

**Architecture:** Keep Filament's registry and rendering pipeline. Guard native alias normalization by API availability, preserving exact strings on older versions. Separate installed-version alias validation from pinned reference-report drift checks.

**Tech Stack:** PHP ^8.2, Laravel 12, Filament ^5.0, Blade Hugeicons 2.1.0, Pest, PHPStan, Pint, Rector, Composer, GitHub Actions.

**Spec:** `docs/superpowers/specs/2026-11-10-filament-5-compatibility-design.md` (approved).

## Global Constraints

- Filament ^5.0 only; Filament 4 remains unsupported.
- Keep PHP ^8.2 and the Blade Hugeicons 2.1.0 catalog.
- Preserve application-wide opt-in replacement, native override priority, fallback, validation, policy agreement, and registry reset replay.
- Preserve the existing README installation guidance and keep README limited to dependencies, installation, and usage.
- Do not change published alpha.3 tags, replace Filament's registry, duplicate upstream alias tables, or publish a release during this implementation.

## Review Focus

- Old registries have distinct alternative spellings; package policy must not pretend they are equivalent.
- Native overrides registered before or after replacement must retain priority on both API variants.
- A scoped registry reset must replay mappings without accumulating callbacks.
- Version-dependent alias classes/constants and report inventories must not crash at the minimum version.
- Composer must install against a locked 5.10.1 without forcing an upgrade to 5.11.2.

## Task 1: Alias compatibility boundary

**Files:** `src/Support/IconMappingRegistry.php`, `tests/Feature/ReplacementPolicyTest.php`, and a focused unit test if a helper is necessary.

**Interfaces:** Keep `normalizeOverrides(mixed $overrides): array` and all public plugin methods. Consume the installed `IconManager` API; use `method_exists(IconManager::class, 'normalizeAlias')` before invoking native normalization. Otherwise retain the alias unchanged.

- [x] Prepare isolated dependency snapshots for Filament 5.0.0 and 5.10.1 without modifying the current checkout's vendor directory. Read the installed manager/provider/component APIs and verify mapped constants.
- [x] Add expectations that older registries preserve distinct alias keys, while registries exposing normalization merge equivalent keys. Retain canonical override precedence and invalid-input rejection in both paths.
- [x] Run the relevant tests against the older dependencies before production edits; confirm failure identifies the missing normalization API.
- [x] Implement the guarded call at the responsible boundary; avoid a new abstraction unless needed for testing.
- [x] Adjust alternative-spelling integration assertions to the installed registry's actual behavior. Do not skip replacement tests wholesale.
- [x] Run focused policy/bootstrap/config tests on 5.0.0, 5.10.1, and current 5.x. Existing tests must continue proving native overrides, disabled defaults, fallback, atomic validation, conflicting policies, and reset replay.

## Task 2: Dependency and coverage compatibility

**Files:** `composer.json`, `scripts/Support/AliasCoverage.php`, `scripts/alias-coverage.php`, `tests/Unit/DefaultIconMappingsTest.php`, `docs/default-icon-coverage.md` if required.

**Interfaces:** Keep `AliasCoverage::aliases(): array` and deterministic `report(): string`. Pin the committed reference report to Filament 5.11.2; validate the installed alias inventory on every lane. Reference drift is checked only with that exact reference dependency installed, using an explicit check mode rather than overwriting expected output.

- [x] Add tests proving mapped constants exist and reference upstream aliases for each installed version. Verify version-dependent inventory classes against source before adapting collection logic.
- [x] Add report checks for deterministic generation on every version, exact committed report equality on the reference version, and a clear failure when explicit reference checking uses a different version.
- [x] Demonstrate relevant failures on old dependencies, then make only the required inventory/report changes.
- [x] Change the production Filament constraint to `^5.0`; retain all other production dependency constraints.
- [x] Run the full quality suite against the minimum, regression, and reference/latest installations; retain strict static analysis and formatting checks. Verify generated icon catalog remains unchanged.

## Task 3: CI, consumer proof, and documentation

**Files:** `.github/workflows/quality.yml`, `README.md`, `PRODUCT.md`, `ARCHITECTURE.md`, `docs/default-icon-replacement.md`, `tests/README.md`, `CHANGELOG.md`, and a new developer compatibility evidence document.

**Interfaces:** Composer independently resolves each version lane. Lowest/latest lanes run PHP 8.2–8.4 with Laravel 12; a 5.10.1 regression lane and a pinned 5.11.2 reference-report lane complement them. Never regenerate the reference report before checking it.

- [x] Add explicit Composer constraints per CI lane; keep upstream skeleton tooling and existing workflow permissions/pins. Run ordinary compatibility checks in each lane and the committed report drift check in the reference lane.
- [x] Build isolated Laravel 12 consumers at exact Filament 5.0.0 and 5.10.1. For the regression consumer, create a lock file before adding the candidate; prove installation succeeds with Filament staying at 5.10.1.
- [x] Verify provider discovery, direct enum rendering, optional replacement, fallback, and override priority in the consumers without package development dependencies.
- [x] Update specifications to the approved ^5.0 scope and document exact alias spelling on older registries. Keep README focused on installation/dependencies/usage; add an Unreleased changelog entry rather than claiming publication.
- [x] Run `composer check` for the reference environment and all compatibility lanes; report exact dependency versions, test counts, and any limitations. Review the complete diff and run `git diff --check`.
- [ ] Commit the verified compatibility change. Do not tag or publish a prerelease as part of this plan.

## Self-review

The three tasks cover all approved design sections. Every review-focus condition is assigned to integration tests, installed-version validation, or the consumer regression proof. No public API or extra rendering layer is introduced. Existing README changes are preserved. Implementation isolation and exact CI commands are routine builder choices within the approved scope.
