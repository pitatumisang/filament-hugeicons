# Phase 1: verified icon catalog

## Intent and constraints

Implement the catalog and explicit enum use specified in PRODUCT.md and ARCHITECTURE.md. Namespace: `EnigmaInc\FilamentHugeicons`. Filament 5 only. No panel plugin registration, custom renderer, runtime catalog scans, or default alias replacement.

## Approach

Retain the installed `afatmustafa/blade-hugeicons` and generate our own public `Icons\Hugeicon` enum. Its 2.1.0 distribution contains 6,839 SVGs, an MIT package license, a provider registering collection `hugeicons`, and default prefix `hugeicons`. There is no supplied enum to adapt. Composer metadata for the alternative `anodyne/blade-hugeicons` also supports Laravel 12/13, but switching providers offers no demonstrated benefit for this phase and introduces another integration to verify. Directly consuming JavaScript icon data would require an unnecessary rendering/asset pipeline.

Pin the runtime Blade dependency to `2.1.0`, so installations use the same catalog used for generation. This is deliberate: widening the range is a future catalog update requiring regeneration and review. Keep PHP `^8.2` and existing Filament constraints.

Record package license, asset provenance (`@hugeicons/core-free-icons`, referenced by the dependency), source version/reference, and verified default prefix. The authoritative npm 4.4.0 tarball was inspected: `package/LICENSE.md` declares MIT, copyright 2025 Hugeicons, matching npm metadata. Preserve the notice in attribution documentation. This verifies the referenced free source license, not the provenance of every transformed SVG individually. Distribute identifiers and dependency metadata, not SVG copies; no Pro assets.

## Generated API and reproducibility

Generate `src/Icons/Hugeicon.php` as a string-backed enum with one case for every SVG in the pinned distribution. Generate `resources/icon-manifest.json` from the same input, including the source version/reference, prefix, case/name/value associations, and deterministic catalog content fingerprints.

Derive PascalCase names by capitalizing each filename word and retaining digits and remaining letter casing. Preserve word boundaries: `play-list` becomes `PlayList`, `playlist` becomes `Playlist`; PHP enum case names are case-sensitive. Fail on exact duplicate case names/backing values, invalid PHP identifiers, unsupported reserved names, an empty catalog, missing/unreadable files, or an unexpected dependency version/prefix. Define a stable `Icon` prefix for any future numeric-leading name; test this even though the current catalog has none. Do not silently rename collisions.

Backing values are the verified default prefix plus real SVG filenames, for example `Home01 = 'hugeicons-home-01'`. Applications must retain the dependency's default `hugeicons` prefix for these enum values. Document that changing the upstream published prefix invalidates the identifiers; do not register a second collection or silently rewrite application config.

Provide `composer icons:generate` and `composer icons:check`. Check mode must perform the same deterministic generation in memory, return nonzero when either generated file differs or input is invalid, and leave files untouched. Generation and checks run only during development/CI. Generator implementation structure is the builder's choice; keep it outside runtime source where practical, include it in PHPStan/Rector/Pint coverage, and test with small isolated fixture catalogs.

## Verification

Generator tests cover deterministic ordering and output, exact name/value collisions, empty/invalid catalogs, numeric-leading names, reserved/invalid identifiers, missing/unreadable inputs, version/prefix mismatch, successful check mode, and drift in either output without writes. Use controlled fixtures for collisions, not invented production SVGs. Ensure generated output also passes Pint and Rector without subsequent drift.

Feature tests enumerate all cases, compare with the real installed catalog, enforce unique backing values, and resolve every case through the dependency's registered Blade Icons factory with fallbacks disabled. Assert actual SVG content rather than mere successful fallback. Verify Filament's native icon renderer and representative Action, TextInput prefix, IconColumn boolean, and navigation item APIs accept enum cases directly. Tests run in the existing Testbench feature harness without registering FilamentHugeiconsPlugin. Use real installed signatures and verify rendered SVG output wherever a component exposes the native rendering path; no mocked renderer.

Add `icons:check` to `composer check` and the existing CI quality workflow through that command. Keep PHPStan max with no baseline/suppressions. Run the complete test suite, Pint, Rector, Composer validation, and catalog drift check. Report exact counts and limitations. Enabled alias replacement and multi-panel behavior remain Phase 2, not acceptance claims for this phase.

## Documentation and completion

Update README with verified enum examples, current catalog count/version, regeneration workflow, prefix limitation, licensing/provenance, and remaining alias-replacement work. Record investigation evidence and update the implementation checklist. Do not mark broader v1 criteria complete merely because the enum is generated.

## Builder check

An independent read-only builder check returned “nothing important left”. The user approved this design; implementation proceeded on 2026-11-10.
