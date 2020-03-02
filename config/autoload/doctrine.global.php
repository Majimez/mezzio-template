<?php
/**
 * Copyright (c) 2019-2020 Martin Meredith <martin@sourceguru.net>
 */

declare(strict_types=1);

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

//use Knp\DoctrineBehaviors\ORM\Geocodable\GeocodableSubscriber;
//use Knp\DoctrineBehaviors\ORM\Sluggable\SluggableSubscriber;
//use Knp\DoctrineBehaviors\ORM\SoftDeletable\SoftDeletableSubscriber;
//use Knp\DoctrineBehaviors\ORM\Timestampable\TimestampableSubscriber;
//use Ramsey\Uuid\Doctrine\UuidBinaryOrderedTimeType;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'url' => sprintf(
                        'mysql://%s:%s@%s:%d/%s',
                        getenv('DB_USER') ?: 'root',
                        getenv('DB_PASS') ?: '',
                        getenv('DB_HOST') ?: 'localhost',
                        getenv('DB_PORT') ?: 3306,
                        getenv('DB_DATABASE') ?: 'reviews'
                    ),
                ],
            ],
        ],
        'types' => [
            //            UuidBinaryOrderedTimeType::NAME => UuidBinaryOrderedTimeType::class,
        ],
        'configuration' => [
            'orm_default' => [
                'naming_strategy' => UnderscoreNamingStrategy::class,
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => MappingDriverChain::class,
                'drivers' => [
                    'App\Entity' => 'my_entity',
                ],
            ],
            'my_entity' => [
                'class' => PHPDriver::class,
                'cache' => 'array',
                'paths' => sprintf(
                    '%s/%s',
                    realpath(__DIR__ . '/..'),
                    'doctrine'
                ),
            ],
        ],
        'event_manager' => [
            'orm_default' => [
                'subscribers' => [
                    //                    GeocodableSubscriber::class,
                    //                    SluggableSubscriber::class,
                    //                    SoftDeletableSubscriber::class,
                    //                    TimestampableSubscriber::class,
                ],
            ],
        ],
    ],
];
