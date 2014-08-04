<?php

namespace Detail\Bernard\Receiver;

use Bernard\Message;

interface ReceiverInterface
{
    public function receive(Message $message);
} 
