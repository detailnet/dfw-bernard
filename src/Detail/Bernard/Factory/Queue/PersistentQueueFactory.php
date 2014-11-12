<?php

namespace Detail\Bernard\Factory\Queue;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\QueueFactory\PersistentFactory;

class PersistentQueueFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Bernard\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        /** @var \Bernard\Driver $driver */
        $driver = $serviceLocator->get($options->getDriver());

        /** @var \Bernard\Serializer $serializer */
        $serializer = $serviceLocator->get($options->getSerializer());

        $queues = new PersistentFactory($driver, $serializer);

        return $queues;
    }
}
