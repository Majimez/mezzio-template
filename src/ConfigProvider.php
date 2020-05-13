<?php

declare(strict_types=1);

namespace App;

use App\Console\Command\ClearConfigCache;
use App\Console\Command\ClearConfigCacheFactory;
use App\Console\Helper\ConnectionHelperFactory;
use App\Console\Helper\EntityManagerHelperFactory;
use App\Console\Helper\HelperSetFactory;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array<string, array<string, array<string, string>>|array<string, string>|array<string, array<string, array<string>>>>
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'console' => ['commands' => $this->getConsoleCommands()],
            'templates' => $this->getTemplates(),
        ];
    }

    /**
     * getDependencies
     *
     * @return array<string, array<string, string>>
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
                QuestionHelper::class => QuestionHelper::class,
            ],
            'factories' => [
                ClearConfigCache::class => ClearConfigCacheFactory::class,
                ConnectionHelper::class => ConnectionHelperFactory::class,
                ConsoleApplication::class => Console\ApplicationFactory::class,
                EntityManagerHelper::class => EntityManagerHelperFactory::class,
                HelperSet::class => HelperSetFactory::class,
            ],
        ];
    }

    /**
     * getConsoleCommands
     *
     * @return array<string, string>
     */
    public function getConsoleCommands(): array
    {
        return [
            'config:cache:clear' => ClearConfigCache::class,
        ];
    }

    /**
     * getTemplates
     *
     * @return array<string, array<string, array<string>>>
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app' => ['templates/app'],
                'error' => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
