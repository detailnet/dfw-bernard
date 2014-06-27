<?php

namespace Detail\Bernard\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Bernard\Consumer;

class ConsumerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Bernard\Router\SimpleRouter $router */
        $router = $serviceLocator->get('Bernard\Router\SimpleRouter');

        /** @var \Bernard\Middleware\MiddlewareBuilder $middleware */
        $middleware = $serviceLocator->get('Bernard\Middleware\MiddlewareBuilder');

        $producer = new Consumer($router, $middleware);

        return $producer;
    }
}
