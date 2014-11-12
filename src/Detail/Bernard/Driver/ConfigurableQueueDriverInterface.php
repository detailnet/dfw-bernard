<?php

namespace Detail\Bernard\Driver;

interface ConfigurableQueueDriverInterface
{
    public function configureQueue($name, array $options = array());
}
