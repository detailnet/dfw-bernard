<?php

namespace Bernard;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

use Zend\Console\Adapter\AdapterInterface as Console;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ConsoleUsageProviderInterface,
    ControllerProviderInterface,
    ServiceProviderInterface
{
    const NAME = 'Bernard';

    /**
     * {@inheritdoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    //__NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                    __NAMESPACE__ => __DIR__,
                    //NAME => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getConsoleUsage(Console $console)
    {
        return array(
            'Actions:',
            'bernard consume [--verbose|-v] <queue>' => 'Consume queue',
            array('<queue>',      'The name of the queue to consume'),
            array('--verbose|-v', '(optional) Turn on verbose mode'),
        );
    }

    public function getControllerConfig()
    {
        return array();
    }

    public function getServiceConfig()
    {
        return array();
    }
}
