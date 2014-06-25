<?php

namespace Detail\Bernard\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Bernard\Options\ModuleOptions;

use RuntimeException;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (!isset($config['bernard'])) {
            throw new RuntimeException('Config for Bernard is not set');
        }

        return new ModuleOptions($config['bernard']);
    }
}
