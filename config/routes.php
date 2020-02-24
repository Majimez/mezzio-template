<?php

declare(strict_types=1);

use Mezzio\Application;

/**
 * @param \Mezzio\Application $app
 * @param \Mezzio\MiddlewareFactory $factory
 * @param \Psr\Container\ContainerInterface $container
 */
return function (Application $app): void {
    $app->get('/', App\Handler\PingHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
};
