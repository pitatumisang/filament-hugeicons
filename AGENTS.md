# Codex Instructions — Filament Hugeicons

You are implementing **Filament Hugeicons**, a Laravel package using the official Filament 5 plugin skeleton. Before making changes, read `PRODUCT.md` and `ARCHITECTURE.md` in full. Treat them as the product contract and technical blueprint.

## First action

The existing local starter was manually scaffolded and **is not verified as an official skeleton clone**. Compare it with `https://github.com/filamentphp/plugin-skeleton/tree/5.x`, adopt the official skeleton's structure and tooling, and preserve these Markdown specifications. Do not proceed as if upstream parity were already established.

## Non-negotiable requirements

- Public `Hugeicon` string-backed enum for direct native Filament icon APIs.
- Free Hugeicons SVGs through Blade Icons, without custom rendering.
- Explicit enum usage works after Composer install, with no panel plugin setup.
- Default Filament icon replacement is optional and off by default.
- Preserve Filament originals for unmapped aliases; custom overrides win.
- Primary target Filament 5; do not claim Filament 4 without tests.
- Use the actual official plugin skeleton's package-tools, tests and workflows.
- Never bundle Hugeicons Pro assets or invent SVG names, prefixes, or Filament alias constants.
- Verify panel isolation before claiming per-panel default icon replacement.

## Working method

1. Inspect installed upstream source and Composer metadata rather than relying on examples alone.
2. Make small, testable changes in the phase order in `ARCHITECTURE.md`.
3. Keep PHP types strict and follow upstream Pint/PHPStan/Pest conventions.
4. Run relevant tests and report exact results; clearly state unverified items and blockers.
5. Avoid unrelated refactoring and unnecessary abstraction.
6. Do not silently select a public Composer vendor namespace; ask for it if needed for publication.

## Definition of done

Use the acceptance checklist in `PRODUCT.md`. A complete implementation must prove every enum value resolves, representative Filament components accept enum cases, opt-in replacement works with fallback/overrides, and all supported tests pass.
