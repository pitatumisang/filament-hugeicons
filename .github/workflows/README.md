# Workflows

Quality checks adapt the official Filament plugin skeleton 5.x workflows at
`820e4ead635a9c15ce59f767c9d0951282f5b388`. The combined read-only quality job
runs Pint, Rector, PHPStan max, and Pest on PHP 8.2–8.4 with Laravel 12
(Testbench 10). Composer resolves Pest 3 on PHP 8.2 and Pest 4 where compatible.
This matrix is configured; local verification covers PHP 8.4 only.

The upstream changelog and workflow security checks are retained. Formatting
fails CI rather than automatically pushing changes. Laravel 11/13, Windows,
and lowest-dependency testing are deferred until compatibility is verified.

## Dependency updates and vulnerability reports

`../dependabot.yml` checks Composer dependencies and GitHub Actions weekly, with
a seven-day cooldown for version updates and up to ten open PRs per ecosystem.
The schedule and cooldown do not delay Dependabot security updates. Automatic
security updates also require the corresponding repository setting to be enabled.
Action references remain pinned to commit SHAs.

The exact Blade Hugeicons version is intentional. When updating it, regenerate
the enum and manifest with `composer icons:generate`, regenerate alias coverage
with `composer icons:coverage`, and run `composer check` before merging.

The security policy in `../SECURITY.md` directs vulnerability reports to GitHub's
private reporting form.
