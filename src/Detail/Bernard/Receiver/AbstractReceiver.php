<?php

namespace Detail\Bernard\Receiver;

use Psr\Log\LoggerAwareInterface;

use Detail\Log\Service\LoggerAwareTrait;

abstract class AbstractReceiver implements
    ReceiverInterface,
    LoggerAwareInterface
{
    use LoggerAwareTrait;
}
