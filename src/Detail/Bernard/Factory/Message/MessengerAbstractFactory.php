<?php

namespace Detail\Bernard\Factory\Message;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Bernard\Message\Messenger;
use Detail\Bernard\Options\Message\MessengerOptions;
use Detail\Bernard\Options\ModuleOptions;

class MessengerAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $messengers = $this->getOptions($serviceLocator)->getMessengers();

        return isset($messengers[$requestedName]);
    }

    /**
     * {@inheritdoc}
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $messengers = $this->getOptions($serviceLocator)->getMessengers();
        $options = new MessengerOptions($messengers[$requestedName]);

        // Note that each the MessageFactory is (most likely) not shared (new instance returned on each SL call)
        /** @var \Detail\Bernard\Message\MessageFactoryInterface $messageFactory */
        $messageFactory = $serviceLocator->get($options->getMessageFactory());

        /** @var \Bernard\Producer $producer */
        $producer = $serviceLocator->get($options->getProducer());

        $messenger = new Messenger($producer, $messageFactory);

        return $messenger;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ModuleOptions
     */
    public function getOptions(ServiceLocatorInterface $serviceLocator)
    {
        if ($this->options !== null) {
            return $this->options;
        }

        /** @var ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Bernard\Options\ModuleOptions');

        $this->options = $options;

        return $options;
    }
}
