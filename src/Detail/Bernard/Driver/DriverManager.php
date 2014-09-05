<?php

namespace Detail\Bernard\Driver;

use Bernard\Driver;

class DriverManager
{
    /**
     * @var Driver
     */
    protected $driver;

    /**
     * @return Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param Driver $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param Driver $driver
     */
    public function __construct(Driver $driver)
    {
        $this->setDriver($driver);
    }

    public function configureQueue($name, array $options = array())
    {
        $driver = $this->getDriver();

        if (!$driver instanceof ConfigurableQueueDriverInterface) {
            return;
        }

        $driver->configureQueue($name, $options);
    }
} 