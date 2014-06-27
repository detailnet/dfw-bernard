<?php

namespace Detail\Bernard\Receiver;

use Psr\Log\LoggerAwareInterface;

/** @todo We should not rely on Application's classes */
use Application\Log\LoggerAwareTrait;

abstract class AbstractReceiver implements LoggerAwareInterface
{
    use LoggerAwareTrait;
}
