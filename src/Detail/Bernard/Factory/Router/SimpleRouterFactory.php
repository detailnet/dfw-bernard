<?php

namespace Detail\Bernard\Factory\Router;

use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\Router\SimpleRouter;

class SimpleRouterFactory extends AbstractRouterFactory
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $receivers = $this->getReceivers($serviceLocator);
        $router = new SimpleRouter($receivers);

        return $router;
    }
}
