<?php

declare(strict_types=1);

use Symfony\Component\Console\Helper\HelperSet;

$container = require __DIR__ . '/container.php';

return $container->get(HelperSet::class);
