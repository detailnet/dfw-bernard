<?php

namespace Detail\Bernard\Factory\Driver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\Driver\FlatFileDriver;

class FlatFileDriverFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Bernard\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        $driver = new FlatFileDriver($options->getDirectory());

        return $driver;
    }
}
