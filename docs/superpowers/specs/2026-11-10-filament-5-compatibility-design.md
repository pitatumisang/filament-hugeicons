# Filament 5 compatibility

Status: approved by the user. Supersedes the earlier requirement for Filament ^5.11.2 after verification; Filament 4 remains unsupported.

## Intent and scope

Support filament/filament ^5.0, including applications locked to 5.10.1, with the existing Hugeicon enum, optional application-wide replacement, configuration, and fluent APIs. Keep PHP ^8.2 and the Blade Hugeicons 2.1.0 catalog. Laravel 12 remains the tested Laravel version. Do not change the published alpha.3 tag or claim Filament 4 support.

## Approach

Chosen direction: one package supporting the whole Filament 5 major with a small compatibility boundary. Requiring only recent Filament releases leaves the reported installation problem unresolved; a separate package branch would duplicate maintenance unnecessarily.

Use upstream alias normalization when the installed IconManager exposes it. Otherwise retain alias strings exactly, matching older Filament registries. Use upstream constants for default mappings. On older versions, alternative spellings are distinct keys; users should use the native constants. Do not copy the newer upstream normalization table, replace Filament's registry, or promise normalization that the installed Filament cannot perform for native registrations.

If inspection reveals another version-dependent API, adapt only the responsible boundary and add a focused test. Preserve native overrides, unmapped fallback, atomic icon validation, opt-in defaults, bootstrap policy agreement, and scoped registry reset replay.

## Validation and tooling

Exercise actual dependency installations for 5.0.0, 5.10.1, and the latest available Filament 5 release. CI must include oldest/latest Filament lanes on PHP 8.2–8.4 plus a 5.10.1 regression lane, resolving compatible dependencies independently. Run the full relevant quality suite in each supported lane; test all enum values, representative native component APIs, provider discovery, replacement, precedence, conflicting declarations, and reset replay.

Audit alias inventory classes and mapped constants against installed versions. Make coverage verification version-aware: maintain a reproducible pinned reference report, while validating installed-version aliases and deterministic report generation in compatibility lanes. Do not simply overwrite and accept a report before every drift check. Version-specific alias tests must assert the installed upstream behavior rather than skip replacement tests wholesale.

Prove the original installation scenario in an isolated Laravel 12 consumer: lock Filament to 5.10.1, install the candidate package without forcing an upgrade to 5.11.2, and verify rendering and replacement. Also check the 5.0.0 minimum in a real consumer.

## Documentation and release

Update Composer to ^5.0 only after successful compatibility tests. Update PRODUCT.md and ARCHITECTURE.md to reflect the user-approved scope and README requirements/usage only. Preserve the existing uncommitted README installation guidance. Document exact alias spelling on older versions and retain application-wide limitations. Record evidence and limitations in developer documentation. Prepare a new prerelease after implementation; publishing is outside this compatibility implementation approval.

## Builder decisions

The implementer chooses the smallest compatibility helper, dependency-isolation mechanism, exact CI layout, pinned report version, and next prerelease number. No public API additions, normalization table duplication, custom renderer, or Filament registry replacement are authorized by this design.
