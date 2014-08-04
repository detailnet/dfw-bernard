<?php

namespace Detail\Bernard\Factory\Router;

use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Bernard\Router\NameBasedRouter;

class NameBasedRouterFactory extends AbstractRouterFactory
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $receivers = $this->getReceivers($serviceLocator);
        $router = new NameBasedRouter($receivers);

        return $router;
    }
}
