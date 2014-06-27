<?php

namespace Detail\Bernard\Factory\Router;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\Router\SimpleRouter;

class SimpleRouterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Bernard\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        $receivers = array();

        foreach ($options->getReceivers() as $name => $class) {
            $receivers[$name] = $serviceLocator->get($class);
        }

        $router = new SimpleRouter($receivers);

        return $router;
    }
}
