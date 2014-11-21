<?php

namespace Detail\Bernard\Queue\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\QueueFactory\InMemoryFactory;

class InMemoryQueueFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $queues = new InMemoryFactory();

        return $queues;
    }
}
