# Filament Hugeicons

Filament 5 integration scaffold for Hugeicons.

> **Status:** Initial scaffold only. This was constructed locally following the conventions of Filament's official plugin skeleton, **not cloned** from the upstream repository. Dependencies have not been installed or verified.

## Intended API

```php
use Vendor\FilamentHugeicons\Icons\Hugeicon;

// After the icon catalog generator is implemented:
// Action::make('edit')->icon(Hugeicon::PencilEdit01);
```

## Optional default replacement

```php
$panel->plugin(
    \Vendor\FilamentHugeicons\FilamentHugeiconsPlugin::make()
        ->replaceDefaultIcons()
);
```

**Not yet implemented:** Hugeicon enum cases, Blade icon name verification, Filament alias mappings, and functional default replacement.

## Next steps

1. Replace this scaffold with or reconcile it against the official `filamentphp/plugin-skeleton` 5.x template when GitHub access is available.
2. Change the placeholder `vendor` Composer name and PHP namespace to the actual publisher.
3. Confirm a stable compatible Blade Hugeicons dependency version; remove the temporary wildcard constraint.
4. Install dependencies with `composer install` (after resolving the dependency version), generate enum cases from actual SVG identifiers, and add tests.
5. Implement and test Filament 5 default icon alias replacement.
