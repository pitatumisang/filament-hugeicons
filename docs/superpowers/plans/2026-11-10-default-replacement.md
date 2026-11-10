# Phase 2 implementation plan

**Spec:** docs/superpowers/specs/2026-11-10-default-replacement-design.md (approved by the user's instruction to continue implementation).
**Goal:** Safe opt-in application-wide icon replacement using native Filament APIs.
**Architecture:** One bootstrap-only policy collector singleton, one registration callback replayed for scoped icon managers, direct upstream alias constants, no renderer/registry replacement.

- [x] Write failing tests for declaration consistency, flags/override precedence, no-op disabled behavior, invalid settings, late changes and native fallback/overrides.
- [x] Implement Support/IconMappingRegistry.php, plugin declarations and provider finalization; validate complete maps before writes; guard mutations and freeze policy.
- [x] Build curated Mappings/DefaultIconMappings.php and reproducible coverage report (independent delegated task).
- [x] Add real provider/bootstrap, multi-panel boot, registry reset and config cache tests. Observe failure first for new behavior.
- [x] Update README/config documentation and acceptance evidence. Retain default prefix and strict tools.
- [x] Run composer check and coverage check; independent code review; address material findings, report actual results, leave uncommitted.

**Review focus:** no alias writes before conflicts are detected; native overrides win; callbacks do not multiply during panel boot; scope reset reapplies only immutable bootstrap policy; disabled flag does not enable overrides; config-only setup does not require plugin registration. No PHPStan suppression or broader compatibility claim.

## Execution evidence and rulings

Implemented on `codex/optional-default-icon-replacement`; changes remain uncommitted.
Default disabled behavior was observed failing before the registry existed, then passed.
Mapping tests were observed red then green by the delegated mapper. Real provider
bootstrap tests pass with a fixture panel provider, config-only opt-in, native panel
booting, and scoped-manager reset replay; repeated plugin boot adds no callbacks.

Independent review found an alias-normalization precedence defect. Both regression
tests were observed failing (config beat fluent; equivalent declarations conflicted),
then passed after canonicalizing aliases before merging and comparison.

Ruling: raise the Phase 2 Filament constraint to `^5.11.2`, requiring the inspected
native IconManager::normalizeAlias API. All mapped constants also exist in upstream
v5.0.0, but that does not establish normalization API availability. This excludes
applications on Filament <=5.11.1 rather than adding untested compatibility shims
or PHPStan suppressions. Review this floor before widening supported versions.

Local verification: `composer check` passed on PHP 8.4: 56 tests, 7,141 assertions;
PHPStan max clean across 23 files; Pint, Rector, Composer metadata, catalog drift,
and alias coverage checks passed. Coverage: 81/221 canonical aliases, Filament 5.11.2.
A separate local Laravel 12 application ran real config:cache, restarted in another
PHP process, and verified cached enum configuration and native alias SVG rendering
without a panel plugin or package development autoloading. Real Octane and remote
PHP 8.2/8.3 CI remain unverified. Simultaneous alpha release documentation edits were
preserved and distinguished from this development branch's implementation.
