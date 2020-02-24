<?php

declare(strict_types=1);

use App\ConfigProvider as AppConfig;
use Dotenv\Dotenv;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use Laminas\HttpHandlerRunner\ConfigProvider as HttpHandlerRunnerConfig;
use Mezzio\ConfigProvider as MezzioConfig;
use Mezzio\Helper\ConfigProvider as HelperConfig;
use Mezzio\Router\ConfigProvider as RouterConfig;
use Mezzio\Router\FastRouteRouter\ConfigProvider as FastRouteRouterConfig;
use Mezzio\Twig\ConfigProvider as TwigConfig;

$dotenv = Dotenv::createImmutable([__DIR__, sprintf('%s/..', __DIR__)]);
$dotenv->load();

$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator(
    [
        HttpHandlerRunnerConfig::class,
        TwigConfig::class,
        FastRouteRouterConfig::class,
        new ArrayProvider($cacheConfig),
        HelperConfig::class,
        MezzioConfig::class,
        RouterConfig::class,
        AppConfig::class,
        new PhpFileProvider(
            sprintf(
                '%s/autoload/{{,*.}global,{,*.}local}.php',
                realpath(__DIR__)
            )
        ),
        new PhpFileProvider(
            sprintf('%s/development.config.php', realpath(__DIR__))
        ),
    ],
    $cacheConfig['config_cache_path']
);

return $aggregator->getMergedConfig();
