# Filament Hugeicons — Product Design

> Publisher selected on 2026-11-10: Composer `enigmainc/filament-hugeicons`, PHP namespace `EnigmaInc\FilamentHugeicons`. Earlier `Vendor` examples below are illustrative placeholders; implementation and README use the selected identity.

> Status: implementation specification, 2026-11-10. This document captures agreed product requirements. Examples of icon case names are illustrative until validated against the selected SVG catalog.

## 1. Vision

Create a lightweight, open-source Laravel package that makes the free Hugeicons icon set feel native to Filament PHP. Developers should be able to use a discoverable, string-backed PHP enum in any Filament icon API, just as they use `Filament\Support\Icons\Heroicon`, and optionally replace Filament's built-in icon choices with curated Hugeicons equivalents.

**Primary API:** `Hugeicon::Home01` (exact case names generated from the chosen icon catalog).

**Key principle:** use Filament's existing icon APIs and Blade Icons rendering; do not invent a new rendering pipeline or fork Filament views.

## 2. Audience and value

- Laravel / Filament developers who prefer Hugeicons while retaining native Filament ergonomics.
- Teams seeking autocomplete and static-analysis-friendly icon identifiers.
- Administrators who want consistent Hugeicons across Filament's default UI, without changing each component manually.

## 3. Agreed scope

### Must have (v1)

1. Filament **5.x** as primary supported major version; Filament 4 is a future compatibility evaluation, not a v1 promise.
2. Project based on the **official `filamentphp/plugin-skeleton` 5.x branch**, preserving its established Composer, package-tools, testing, quality, and release conventions.
3. A public **singular** `Hugeicon` string-backed PHP enum, with a case for every supported free SVG in the locked source catalog.
4. Native Filament usage without `->value`, manual SVG paths, manual icon registration, or panel plugin registration for **explicit** enum usage.
5. SVGs rendered by a registered **Blade Icons** collection supplied by a compatible Hugeicons package, or a documented fallback if that dependency cannot meet requirements.
6. Optional, **disabled-by-default**, mapping of Filament's internal icon aliases to Hugeicons.
7. User-defined overrides take priority over package mappings; unmapped aliases retain Filament defaults.
8. Composer package auto-discovery; clear README and examples; deterministic icon generation; automated validation and tests.
9. Hugeicons **Free** only in the distributed package. No redistribution of proprietary/pro-only assets.

### Should have

- Config publish command using the skeleton's Spatie Laravel Package Tools conventions.
- Opt-in fluent plugin API: `FilamentHugeiconsPlugin::make()->replaceDefaultIcons()`.
- Custom alias override API: `->overrideAliases([...])` after verifying supported key/value types.
- Explicit coverage report for default alias mappings.
- Reproducible catalog update command and CI drift check.

### Out of scope for v1

- Hugeicons Pro assets, licensing, or authenticated downloads.
- Icon picker UI, interactive search panel, theme builder, or custom SVG renderer.
- Guaranteed per-panel default replacement until global icon registry isolation is proven.
- Automatic matching of every Filament alias by fuzzy icon-name similarity.
- Filament 4 compatibility claim without a separate supported test matrix.

## 4. Developer experience

### 4.1 Explicit icon usage (zero plugin setup)

```php
use Vendor\FilamentHugeicons\Icons\Hugeicon;

Action::make('edit')->icon(Hugeicon::PencilEdit01);
TextInput::make('search')->prefixIcon(Hugeicon::Search01);
IconColumn::make('active')->trueIcon(Hugeicon::CheckmarkCircle01);
```

These names are **examples**, not verified catalog declarations. Namespace `Vendor` is a **placeholder** to replace with the actual publisher namespace before release. Use Filament's real type declarations for resource navigation, actions, etc.; avoid claiming a specific property signature until checked against installed Filament 5.

### 4.2 Optional default replacement

```php
use Vendor\FilamentHugeicons\FilamentHugeiconsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel->plugin(
        FilamentHugeiconsPlugin::make()->replaceDefaultIcons()
    );
}
```

Plugin registration must not be required for explicit `Hugeicon` use. Default replacement is opt-in, and **application-wide may be the only supported scope** if Filament's alias registry is global. Document that limitation prominently if confirmed.

### 4.3 Custom mappings

Desired fluent API (subject to validation of Filament alias keys):

```php
FilamentHugeiconsPlugin::make()
    ->replaceDefaultIcons()
    ->overrideAliases([
        // Filament alias => Hugeicon enum case or registered icon name
    ]);
```

Do not expose a fluent API that silently fails or changes other panels unpredictably. If configuration and fluent overrides conflict, define deterministic precedence and test it.

## 5. Functional behavior

| Situation | Expected result |
|---|---|
| Package installed, no plugin | Explicit `Hugeicon` cases render |
| Default replacement disabled | Filament's internal defaults remain unchanged |
| Replacement enabled | Mapped Filament internal aliases use Hugeicons |
| Alias not mapped | Original Filament icon remains |
| Developer override provided | Override wins over bundled mapping |
| Enum references absent SVG | Generation/CI fails; never ship broken case |
| Multiple panels with conflicting settings | Fail clearly, constrain scope, or implement proven isolation; no silent leakage |
| SVG dependency version changes | Catalog consistency test catches drift |

## 6. Configuration philosophy

Keep config small. Candidate keys:

```php
return [
    'replace_default_icons' => false,
    'overrides' => [],
];
```

Decide whether `replace_default_icons` is controlled by configuration, fluent plugin API, or both, and define precedence **before** implementing it. A proposed rule is: explicit fluent option > published config > disabled default. However, do not implement ambiguous cross-panel behavior without validation.

## 7. Quality requirements

- Static typing, IDE completion, deterministic enum names and stable backing values.
- No runtime reflection/scanning of all SVG files on each request.
- No extra network requests for icon rendering; SVGs render through Blade Icons.
- Respect SVG security: only trusted bundled assets, no unsafe user-supplied markup.
- No unnecessary migrations, database models, assets, JavaScript, CSS, or view overrides.
- Preserve upstream skeleton workflows and coding standards.
- CI tests should cover all generated cases, representative Filament components, alias fallback and overrides, and package installation.

## 8. Acceptance criteria (v1)

- [ ] Project can be installed through Composer with documented supported versions.
- [x] `Hugeicon` is a string-backed enum with validated names/values.
- [x] Every enum case resolves to a real registered SVG.
- [x] Enum works directly in representative Filament 5 icon APIs without `->value`.
- [x] Explicit icon usage works with no panel plugin registration.
- [x] Default Filament icons are unchanged unless replacement is enabled.
- [x] Enabling replacement maps documented aliases and preserves fallback.
- [x] Custom override priority is tested.
- [x] Multi-panel limitations are tested and documented.
- [ ] Package passes Pest, PHPStan/Larastan, Pint and applicable skeleton checks.
- [ ] README documents install, usage, opt-in replacement, customization, limits and licensing.

## 9. Release plan

1. **Foundation:** reconcile local scaffold against actual official 5.x skeleton; lock dependencies and namespace.
2. **Catalog:** select Blade Hugeicons source; generate and validate enum and manifest.
3. **Integration:** verify native icon rendering in Filament 5 contexts.
4. **Replacement:** implement verified alias mappings and override precedence.
5. **Hardening:** tests, multi-panel behavior, CI, docs, release.

## 10. References and unresolved questions

- Official skeleton: https://github.com/filamentphp/plugin-skeleton (use `5.x` branch and inspect current source).
- Filament documentation: https://filamentphp.com/docs
- Hugeicons documentation: https://hugeicons.com/docs
- Candidate Blade source: https://github.com/afatmustafa/blade-hugeicons
- Alternative: https://github.com/anodyne/blade-hugeicons
- Prior-art plugin: https://github.com/filafly/filament-hugeicons-icons

**Verification required before implementation:** current upstream skeleton structure, exact Filament 5 alias types/API, Blade dependency icon prefix and license, enum support across Filament components, whether per-panel alias isolation is possible, Composer version constraints, and final vendor namespace.
