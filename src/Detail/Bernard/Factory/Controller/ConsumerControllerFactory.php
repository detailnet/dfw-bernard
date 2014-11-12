<?php

namespace Detail\Bernard\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Bernard\Controller\ConsumerController;

class ConsumerControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        /** @var \Zend\Mvc\Controller\ControllerManager $controllerManager */

        $serviceLocator = $controllerManager->getServiceLocator();

        /** @var \Detail\Bernard\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        /** @var \Bernard\QueueFactory $queues */
        $queues = $serviceLocator->get($options->getQueue());

        /** @var \Bernard\Consumer $consumer */
        $consumer = $serviceLocator->get('Bernard\Consumer');

        $controller = new ConsumerController($consumer, $queues);

        return $controller;
    }
}
