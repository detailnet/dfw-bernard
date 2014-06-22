<?php

namespace Detail\Bernard\Factory\Driver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\Driver\IronMqDriver;

class IronMqDriverFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Bernard\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        /** @var \IronMQ $ironMq */
        $ironMq = $serviceLocator->get('IronMQ');

        $driver = new IronMqDriver($ironMq, $options->getPrefetch());

        return $driver;
    }
}
