<?php

declare(strict_types=1);

return [
    'name' => 'Migrations',
    'migrations_namespace' => 'App\Migrations',
    'migrations_directory' => sprintf(
        '%s/%s',
        realpath(__DIR__),
        'src/Migrations'
    ),
];
