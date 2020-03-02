<?php

declare(strict_types=1);

namespace App\Console\Helper;

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Class HelperSetFactory
 *
 * @package App\Console
 */
final class HelperSetFactory
{
    /**
     * __invoke
     *
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\Console\Helper\HelperSet
     */
    public function __invoke(ContainerInterface $container)
    {
        return new HelperSet(
            [
                'em' => $container->get(EntityManagerHelper::class),
                'db' => $container->get(ConnectionHelper::class),
                'question' => $container->get(QuestionHelper::class),
            ]
        );
    }
}
