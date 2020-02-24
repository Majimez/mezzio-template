<?php

declare(strict_types=1);

namespace App\Console\Helper;

use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;

/**
 * Class EntityManagerHelperFactory
 *
 * @package App\Console\Helper
 */
final class EntityManagerHelperFactory
{
    /**
     * __invoke
     *
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper
     */
    public function __invoke(ContainerInterface $container)
    {
        return new EntityManagerHelper(
            $container->get('doctrine.entity_manager.orm_default')
        );
    }
}
