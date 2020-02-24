<?php

declare(strict_types=1);

use Symfony\Component\Console\Application;

chdir(__DIR__ . '/../');

require_once __DIR__ . '/../vendor/autoload.php';
$container = require __DIR__ . '/../config/container.php';

$application = $container->get(Application::class);

$application->run();
