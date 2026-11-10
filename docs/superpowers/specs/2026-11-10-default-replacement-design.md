# Phase 2: optional default icon replacement

## Intent

Implement the PRODUCT.md and ARCHITECTURE.md optional alias replacement feature using native Filament APIs. Keep explicit Hugeicon usage independent of panel plugins. No view overrides, renderer, SVG scanning, or registry replacement.

## Verified lifecycle and chosen scope

Installed Filament 5.11.2 binds IconManager as a Laravel scoped service. Its alias map is shared by panels in that scope. Panel::boot registers panel icons before plugin boot; it never removes another panel's aliases. FilamentIcon::register installs an after-resolving callback, so registrations replay when the scoped service is recreated.

A separate Laravel application demonstrated this with real Panel::boot calls: panel A registered GLOBAL_SEARCH_FIELD as Hugeicon::Search01; panel B with no icons still resolved that case; recreating the scoped registry also resolved it because the callback replayed. Panel registration does not provide isolation.

**Recommended approach: application-wide replacement only.** Global config is the simplest entry point. Retain the requested fluent plugin API as an application-wide configuration declaration, not a panel-local switch. Detect incompatible declarations before registering any package aliases. Panels without this plugin still receive the global replacement. All documentation and examples must state this plainly.

Alternative: replace/decorate Filament's scoped registry and resolve icons dynamically for the current panel. This would need invasive lifecycle integration, rules for non-panel components, and worker guarantees that are not proven. Defer it; no isolation claim in v1.

## Public API and configuration

Keep config defaults:

```php
return [
    'replace_default_icons' => false,
    'overrides' => [],
];
```

A global config opt-in works without panel plugin registration. The existing API remains valid:

```php
FilamentHugeiconsPlugin::make()
    ->replaceDefaultIcons()
    ->overrideAliases([
        PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search02,
    ]);
```

Plugin properties distinguish an unspecified replacement flag from explicit true/false. For each declaration, the effective flag is explicit fluent flag > config flag > false. Override maps merge config overrides followed by fluent overrides, with fluent values winning. Calling overrideAliases repeatedly merges entries, with later values winning. All settings are application-wide.

Override keys are nonempty alias strings (installed upstream aliases are class string constants, not enums). Values support Hugeicon cases and nonempty registered Blade Icons strings. No arbitrary Htmlable/markup API is needed in this package; developers can continue using native FilamentIcon registration for those. Validate types and Blade resolution with actionable exceptions; follow Blade Icons' native string resolution/fallback behavior and document that custom strings remain subject to application fallback configuration. Do not scan catalogs or add another icon collection. Runtime validation is limited to the small replacement/override map and performed when creating each scoped registry.

If replacement is false, do not apply bundled mappings or package config/fluent overrides. Overrides alone do not enable replacement. Invalid configuration types still fail clearly. This avoids a disabled package mutating aliases.

## Lifecycle and consistency

Use one small application singleton to collect effective declarations from plugin register methods. Plugin register has no icon-registry side effect. The service provider loads config using Package Tools as today.

After application providers have booted, ensure the native panel registry has been resolved, collect/finalize all declarations, validate consistency, freeze the policy, and install one native FilamentIcon after-resolving callback when enabled. Filament's panel providers register their configuration in the normal provider registration/boot sequence; forcing resolution at finalization ensures declarations are evaluated before freezing. Do not install one callback per panel or per request.

No plugin declarations: the policy comes from config. One or more declarations: all their resolved effective flags and merged override maps must agree (map order does not matter). Any disagreement throws a clear LogicException listing the application-wide limitation before any package mappings are installed. Panels without this plugin do not count as a false declaration. Configuration may be explicitly disabled consistently across plugin declarations even when config is true.

After freezing, registering a plugin with identical effective policy is idempotent. A new incompatible declaration or mutation of a registered plugin's settings fails clearly instead of changing live registry state. Assert the frozen declaration again during plugin boot to catch a plugin mutated after registration. Document that policy must be declared during application bootstrap, not mutated per request or per tenant; restart workers after config changes. The default disabled plugin remains harmless when constructed after boot, as existing tests do.

The singleton stores bootstrap configuration only, not current panel, request, tenant, user, or scoped IconManager instances. Each new scoped IconManager receives the same policy through the registered native callback. Test this replay and verify callback count does not grow with repeated panel boots.

## Precedence and fallback

For a given alias:

1. Native developer registrations (FilamentIcon::register and panel icons) win over all package values.
2. Fluent overrides win over published config overrides.
3. Config overrides win over the bundled map.
4. Unmapped aliases remain unregistered and use Filament's original fallback.

At callback time, fill only aliases whose native registry resolve returns null. Never overwrite an existing native value. Native registrations after package application also win through Filament's own last-registration semantics. This defines deterministic precedence for users who mix package options with their existing native customizations. Do not use reflection or direct access to protected registry storage, and do not clear/rebuild the registry.

Build and validate the desired map before writing any of its entries, so an invalid override does not leave partial mappings in a scoped registry. Validate mapped Hugeicon values and custom strings with the Blade factory. Preserve the existing documented default hugeicons prefix requirement.

## Curated mappings and coverage

Use real upstream constants from the installed alias classes and verified Hugeicon cases. Cover a conservative set of common UI roles: search; dashboard home; edit/view/delete/copy/restore actions; logout; sidebar/menu arrows with correct RTL directions; modal/notification close; pagination including first/last/RTL; notification statuses; table filter/search and boolean states; representative builder/repeater controls where semantics match.

Leave uncertain/specialized aliases unchanged, including complex editor tools and any role without a defensible equivalent. No fuzzy automatic matching or guessed constants. Exact map contents are implementation decisions checked against source, icon semantics, and tests.

Provide a reproducible coverage report documenting mapped and unmapped canonical aliases by upstream component namespace, deduplicating deprecated equivalent constants. Record the tested Filament version. Production mapping uses direct constants and no runtime reflection; development coverage generation may inspect upstream alias declarations. Any compatibility floor increase needed for chosen constants must be explicit and justified; do not claim Filament 4 compatibility.

## Tests and completion evidence

- Disabled config/plugin: zero package alias mutation; explicit enum usage still works.
- Config-only and fluent opt-in: real native aliases render expected Hugeicons through native Filament icon rendering.
- Every bundled mapping key is a real upstream alias and every value resolves to its real SVG.
- An unmapped alias still renders its original Filament fallback.
- Config vs fluent precedence; repeated override calls; invalid keys/values/types; missing string icons under default no-fallback config; overrides while disabled.
- Existing native and panel icon overrides win, before and after package registration.
- Consistent multi-panel declarations succeed; conflicting true/false or overrides fail before package mutation; panels lacking the plugin share the documented global policy.
- Actual panel boot sequence and registry scope reset replay; no per-request state or callback accumulation; late incompatible declaration/plugin mutation fails clearly.
- Config publication/caching handles string overrides and Hugeicon cases; no panel plugin needed for explicit enum use.
- Coverage report is reproducible and truthful; unverified combinations remain documented.

Run all existing catalog tests and composer check (catalog drift, strict metadata, PHPStan max without suppressions, Pint, Rector, Pest). Record exact test results and independent review. Leave changes uncommitted for the user's usual review/commit step. This phase does not publish the package or complete the remaining release compatibility matrix.

## Builder check

An independent read-only builder check returned “nothing important left”. The user approved implementation on a new branch. Implementation proceeded on codex/optional-default-icon-replacement.
