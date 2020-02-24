<?php

declare(strict_types=1);

namespace App\Console\Helper;

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Psr\Container\ContainerInterface;

/**
 * Class ConnectionHelperFactory
 *
 * @package App\Console\Helper
 */
final class ConnectionHelperFactory
{
    /**
     * __invoke
     *
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ConnectionHelper(
            $container->get('doctrine.connection.orm_default')
        );
    }
}
