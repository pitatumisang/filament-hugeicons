<?php

declare(strict_types=1);

return [
    // Application-wide. Declare at bootstrap, then restart long-running workers.
    'replace_default_icons' => false,
    // Alias string => Hugeicon case or registered Blade Icons string.
    // Applied only when replacement is enabled; native Filament overrides win.
    'overrides' => [],
];
