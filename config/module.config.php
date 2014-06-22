<?php

return array(
    'service_manager' => array(
        'abstract_factories' => array(
        ),
        'aliases' => array(
        ),
        'invokables' => array(
            'Bernard\Middleware\MiddlewareBuilder' => 'Bernard\Middleware\MiddlewareBuilder',
            'Bernard\Serializer\SimpleSerializer'  => 'Bernard\Serializer\SimpleSerializer',
            /** @todo Add support for JMSSerializer and SymfonySerializer */
        ),
        'factories' => array(
            'Detail\Bernard\Options\ModuleOptions' => 'Detail\Bernard\Factory\ModuleOptionsFactory',
            'Bernard\Driver\FlatFileDriver'        => 'Detail\Bernard\Factory\Driver\FlatFileDriverFactory',
            'Bernard\Driver\IronMqDriver'          => 'Detail\Bernard\Factory\Driver\IronMqDriverFactory',
            'Bernard\Queue\InMemoryQueue'          => 'Detail\Bernard\Factory\Queue\InMemoryQueueFactory',
            'Bernard\Queue\PersistentQueue'        => 'Detail\Bernard\Factory\Queue\PersistentQueueFactory',
            'Bernard\Producer'                     => 'Detail\Bernard\Factory\ProducerFactory',
        ),
        'initializers' => array(
        ),
    ),
    'bernard' => array(
        'driver'     => 'Bernard\Driver\FlatFileDriver',
        'serializer' => 'Bernard\Serializer\SimpleSerializer',
        'queue'      => 'Bernard\Queue\InMemoryQueue',
        'prefetch'   => null,
        'directory'  => __DIR__ . '/../../../data/queues',
    ),
);
