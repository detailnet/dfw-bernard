<?php

namespace Detail\Bernard\Factory\Router;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractRouterFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return array
     */
    protected function getReceivers(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Bernard\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        $receivers = array();

        foreach ($options->getReceivers() as $name => $class) {
            $receivers[$name] = $serviceLocator->get($class);
        }

        return $receivers;
    }
}
