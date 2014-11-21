<?php

namespace Detail\Bernard\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\Producer;

class ProducerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Bernard\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        /** @var \Bernard\QueueFactory $queues */
        $queues = $serviceLocator->get($options->getQueue());

        /** @var \Bernard\Middleware\MiddlewareBuilder $middleware */
        $middleware = $serviceLocator->get('Bernard\Middleware\MiddlewareBuilder');

        $producer = new Producer($queues, $middleware);

        return $producer;
    }
}
