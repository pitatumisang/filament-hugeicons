# Filament 5 compatibility verification

Release `0.1.0-alpha.4` supports `filament/filament: ^5.0` and `php: ^8.2`.
Filament 4 remains unsupported. Published alpha.3 retains its original ^5.11.2
requirement; alpha.4 is the release that broadens replacement compatibility.

Filament's documented PHP minimum and both its 5.0.0 and 5.11.2 Composer metadata
require PHP ^8.2. Raising this package's floor to 8.3 would unnecessarily exclude
supported Filament installations.

## Local proof — 2026-11-10

Independent dependency snapshots ran `composer check` on PHP 8.4.27 / Laravel 12:

| Filament | Pest | Assertions | Other quality checks |
| --- | --- | --- | --- |
| 5.0.0 | 57 passed | 7,146 | Composer validation, catalog/alias checks, Pint, Rector, PHPStan max passed |
| 5.10.1 | 57 passed | 7,146 | Same checks passed |
| 5.11.2 (latest stable 5.x and reference) | 57 passed | 7,145 | Same checks plus explicit reference-report drift check passed |

The different assertion count reflects exact-key versus normalized alias behavior,
not skipped replacement tests. All 6,839 enum cases resolve against real SVGs in
all three installations. No generated catalog or committed coverage report changed.

Before the compatibility fix, the 5.10.1 policy suite failed seven tests with the
undefined IconManager::normalizeAlias method. The guarded implementation passes
those tests. Older coverage tests also reproduced missing SchemasIconAlias errors;
the inventory now includes that optional upstream class only when available.

Separate Laravel 12 consumers first installed and locked exact Filament 5.0.0 and
5.10.1, then installed the candidate package through a mirrored local path repository
without `-W` and without package development dependencies. Every previously locked
package remained unchanged (108 existing packages on 5.0.0; 109 on 5.10.1).
Both consumers verified provider auto-discovery, all enum cases, direct SVG rendering
without panel registration, disabled defaults, enabled config replacement, config
customization, unmapped fallback, and native developer override priority.

These path-repository tests prove candidate dependency/API compatibility, not a
published release or Packagist installation of the new code.

## Compatibility decisions

- Older registries preserve exact alias strings. Newer ones expose native
  normalization; the package delegates to it. Native constants are recommended.
- Optional-method detection/invocation uses a small reflection boundary with a
  checked string result, keeping strict static analysis valid on old and new APIs
  without suppressions or copying Filament's alias table. It scans no catalog or
  alias constants at runtime.
- The committed alias report stays pinned to 5.11.2. `icons:coverage:check` validates
  the installed inventory and compares the reference only on that version.
  `icons:coverage:reference:check` explicitly rejects a different version.
- Reference regeneration requires 5.11.2. Compatibility CI never overwrites the
  expected report before checking it.

## CI and limitations

CI is configured for PHP 8.2–8.4 on exact 5.0.0 and latest 5.x, plus 5.10.1 and
5.11.2 reference lanes on PHP 8.4. The local proof above covers PHP 8.4; the remote runs below verify the expanded PHP matrix. Intermediate patches are covered by the
supported Composer range, not a claim that every historical patch was run locally.

Filament 5.0.0 has published security advisories and Composer blocks installation
by default. Advisory blocking was disabled only in the isolated historical local
installations and is disabled only in that CI lane. Normal/current installation
protections and consumer guidance are unchanged; compatibility is not a recommendation
to deploy a vulnerable historical release.

Application-wide replacement limitations remain unchanged. Per-panel/per-tenant policy
is unsupported, and a real Octane server has not been tested.


## Remote verification

Commit `5e42258` passed [all eight quality jobs](https://github.com/pitatumisang/filament-hugeicons/actions/runs/42798361459):
minimum/latest on PHP 8.2, 8.3, and 8.4, plus exact 5.10.1 and the 5.11.2 reference
report on PHP 8.4. The [workflow security check](https://github.com/pitatumisang/filament-hugeicons/actions/runs/42798361600)
also passed. These results prove the reviewed candidate commit. Alpha.4 publication and
clean Packagist consumer verification are recorded below; alpha.3 remains unchanged.


Independent review of the complete implementation found no actionable critical,
important, or minor issues. Read-only probes on all three versions confirmed
normalization semantics, override resolution, mapping inventory, and report
determinism. Real Octane behavior and release publication remain outside this change.


## Published compatibility release

[Alpha.4](https://github.com/pitatumisang/filament-hugeicons/releases/tag/v0.1.0-alpha.4)
was published from `f3286e2ae2eb4dce83de3390e6ba66c4a9c19f16` after all eight
[release CI lanes](https://github.com/pitatumisang/filament-hugeicons/actions/runs/42799905365)
passed. Packagist indexes that exact commit. Fresh Laravel 12 consumers installed
exact `0.1.0-alpha.4` from Packagist, without path/VCS repositories or package
development dependencies, while preserving every existing locked dependency on
Filament 5.0.0 and 5.10.1. Discovery, rendering, replacement, fallback, and overrides
passed in both consumers. See the [release verification record](releases/0.1.0-alpha.4.md).
