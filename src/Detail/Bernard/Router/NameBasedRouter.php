<?php

namespace Detail\Bernard\Router;

use Bernard\Envelope;
use Bernard\Router\SimpleRouter;

use Detail\Bernard\Receiver\ReceiverInterface;

class NameBasedRouter extends SimpleRouter
{
    const RECEIVE_METHOD_NAME = 'receive';

    /**
     * {@inheritDoc}
     */
    public function map(Envelope $envelope)
    {
        $callback = parent::map($envelope);
        $callback[1] = self::RECEIVE_METHOD_NAME;

        return $callback;
    }

    /**
     * @param  mixed   $receiver
     * @return boolean
     */
    protected function accepts($receiver)
    {
        return $receiver instanceof ReceiverInterface;
    }
} 
