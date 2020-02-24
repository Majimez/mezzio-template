<?php
/**
 * Copyright (c) 2019-2020 Martin Meredith <martin@sourceguru.net>
 */

declare(strict_types=1);

namespace App\Console\Command;

use Psr\Container\ContainerInterface;

/**
 * Class ClearConfigCacheFactory
 *
 * @package App\Console\Command
 */
final class ClearConfigCacheFactory
{
    /**
     * __invoke
     *
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \App\Console\Command\ClearConfigCache
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        $path = $config['config_cache_path'] ?? null;

        return new ClearConfigCache($path);
    }
}
