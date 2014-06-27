<?php

namespace Detail\Bernard\Options;

class ModuleOptions extends AbstractOptions
{
    protected $driver = 'Bernard\Driver\FlatFileDriver';

    protected $serializer = 'Bernard\Serializer\SimpleSerializer';

    protected $queue = 'Bernard\Queue\InMemoryQueue';

    protected $prefetch = null;

    protected $directory = null;

    protected $receivers = array();

    /**
     * @param null $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @return null
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param null $prefetch
     */
    public function setPrefetch($prefetch)
    {
        $this->prefetch = $prefetch;
    }

    /**
     * @return null
     */
    public function getPrefetch()
    {
        return $this->prefetch;
    }

    /**
     * @param string $queue
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;
    }

    /**
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param string $serializer
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return string
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @return array
     */
    public function getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @param array $receivers
     */
    public function setReceivers($receivers)
    {
        $this->receivers = $receivers;
    }
}
