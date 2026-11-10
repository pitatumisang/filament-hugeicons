# Icon catalog implementation plan

**Goal:** Ship the approved Phase 1 generated enum and prove native Filament rendering.
**Spec:** docs/superpowers/specs/2026-11-10-icon-catalog-design.md
**Architecture:** Development-only deterministic generator; exact source dependency; runtime backed enum and ordinary Blade Icons rendering.
**Tech stack:** PHP 8.2+, Filament 5, Blade Hugeicons 2.1.0, Pest, PHPStan max, Rector, Pint.

## Task 1: generation and drift checking

- [x] Add fixture-based generator tests for ordering, identifiers, collisions, missing/unreadable/empty catalog, source version/prefix validation, and non-mutating output checks. Run them and observe missing generator failure.
- [x] Implement development generator and CLI; pin source dependency; generate enum/manifest with source reference and per-SVG hashes. Include scripts in PHPStan and Rector coverage.
- [x] Verify generation and output checks, including drift in each output; run quality tools until generator and checked-in output agree.

## Task 2: native integration and delivery

- [x] Add feature tests for full catalog parity and every SVG through the registered Blade factory without fallbacks; observe missing enum-case tests fail before generation where practical.
- [x] Verify native renderer and real Action, TextInput, IconColumn, and NavigationItem accept cases without panel registration. Test real SVG output.
- [x] Wire generation drift check into composer check; update README, provenance/license notices, and acceptance evidence.
- [x] Run complete composer check and Composer validation. Review changes independently and address material findings. Leave changes uncommitted for the user's normal review/commit flow.

## Constraints and review focus

No renderer, extra collection, runtime scans, alias replacement, or Pro assets. Preserve case-sensitive filename word boundaries. Retain default hugeicons prefix; document custom-prefix incompatibility. Exact Blade version prevents downstream catalog drift. Check both outputs without writes. Validate real SVG content, not a fallback.

## Verification and review

Generator unit tests and the integration tests were observed failing before implementation/generation, then passing. An empty SVG regression was observed failing with a DOM ValueError, then fixed to report a catalog error. Independent review found no material defects.

Ruling: retain the approved exact 2.1.0 pin. Composer's generic advice discourages exact pins, so test:composer uses --strict --no-check-lock --no-check-all; schema/publish checks remain strict, while overly strict/loose constraint advice is disabled. This trades generic version-range advice for catalog stability; future constraint changes require review.

Local verification on PHP 8.4: composer check passes; 31 tests, 6,925 assertions; PHPStan max clean across 14 files; Pint, Rector, and catalog drift checks clean. PHP 8.2/8.3 remote CI remains unverified. Changes intentionally remain uncommitted.

Consuming-app verification: a separate local Laravel 12 application with the package installed as a Composer path dependency rendered Hugeicon::Home01 through Filament’s native helper without panel setup or package development autoloading, and saw all 6,839 cases.
