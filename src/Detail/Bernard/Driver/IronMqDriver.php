<?php

namespace Detail\Bernard\Driver;

use Bernard\Driver\IronMqDriver as BernardIronMqDriver;

class IronMqDriver extends BernardIronMqDriver implements
    ConfigurableQueueDriverInterface
{
    public function configureQueue($name, array $options = array())
    {
        $this->ironmq->updateQueue($name, $options);
    }
}
