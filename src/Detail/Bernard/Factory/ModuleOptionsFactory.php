<?php

namespace Detail\Bernard\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Bernard\Options\ModuleOptions;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ModuleOptions($serviceLocator->get('Config')['bernard']); /** @todo Check for existence */
    }
}
