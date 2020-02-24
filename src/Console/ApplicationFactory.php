<?php

declare(strict_types=1);

namespace App\Console;

use Doctrine\Migrations\Tools\Console\ConsoleRunner as MigrationsConsoleRunner;
use Doctrine\ORM\Tools\Console\ConsoleRunner as ORMConsoleRunner;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Class ApplicationFactory
 *
 * @package App\Console
 */
final class ApplicationFactory
{
    /**
     * __invoke
     *
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\Console\Application
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __invoke(ContainerInterface $container)
    {
        $application = new Application('App Console Commands');
        $config = $container->get('config')['console'];

        $application->setCommandLoader(
            new ContainerCommandLoader(
                $container,
                $config['commands']
            )
        );

        $application->setDefaultCommand('list');
        $application->setHelperSet($container->get(HelperSet::class));

        MigrationsConsoleRunner::addCommands($application);
        ORMConsoleRunner::addCommands($application);

        return $application;
    }
}
