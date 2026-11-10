# Foundation implementation plan

**Goal:** Finish the Phase 0 foundation described in the agreed PRODUCT.md and ARCHITECTURE.md.

**Approach:** Adapt the official 5.x skeleton’s Testbench/Pest harness to this database-free package. Keep the existing strict quality tooling and explicit differences recorded in docs/upstream-skeleton.md. Rebuilding from an unconfigured template would overwrite the reviewed package setup without adding behavior.

- [x] Re-read specifications and compare the actual upstream skeleton commit.
- [x] Confirm publisher identity and replace Composer/PSR-4/provider/test namespace references; preserve historical illustrative specifications.
- [x] Add the upstream-style Orchestra Testbench base class and scope it to feature tests.
- [x] Verify provider booting, disabled replacement defaults, config publication, and unmodified existing icon aliases without panel registration.
- [x] Verify auto-discovery in a separate consuming application; normal Pest runs explicitly register the root provider per upstream conventions.
- [x] Run composer check and Composer validation; document exact results and remaining compatibility limitations.

**Constraints:** No catalog generation or replacement implementation in Phase 0. No database, custom rendering, or invented icon/alias identifiers. Publisher identity selected by user: `enigmainc/filament-hugeicons` / `EnigmaInc\FilamentHugeicons`.

Verification: `composer check` passed on PHP 8.4: 14 tests, 32 assertions; PHPStan max clean across 10 files; Pint and Rector clean. Publisher selection applied. A separate Laravel 12 consuming application installed via a local Composer path repository and verified provider discovery and disabled defaults without panel setup. Composer validation passed.
