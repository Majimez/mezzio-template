<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Twig\TwigRenderer;
use Roave\PsrContainerDoctrine\ConnectionFactory;
use Roave\PsrContainerDoctrine\EntityManagerFactory;

return [
    'dependencies' => [
        'aliases' => [
            TemplateRendererInterface::class => TwigRenderer::class,
            EntityManagerInterface::class => 'doctrine.entity_manager.orm_default',
        ],
        'factories' => [
            'doctrine.connection.orm_default' => ConnectionFactory::class,
            'doctrine.entity_manager.orm_default' => EntityManagerFactory::class,
        ],
        'invokables' => [
            UnderscoreNamingStrategy::class => UnderscoreNamingStrategy::class,
        ],
    ],
];
