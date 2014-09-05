<?php

namespace Detail\Bernard\Factory\Driver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Bernard\Driver\DriverManager;

class DriverManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Bernard\Options\ModuleOptions $moduleOptions */
        $moduleOptions = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        /** @var \Bernard\Driver $driver */
        $driver = $serviceLocator->get($moduleOptions->getDriver());

        $driver = new DriverManager($driver);

        return $driver;
    }
}
