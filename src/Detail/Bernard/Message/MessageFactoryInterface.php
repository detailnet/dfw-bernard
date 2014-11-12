<?php

namespace Detail\Bernard\Message;

interface MessageFactoryInterface
{
    /**
     * Does the factory accept the provided message?
     *
     * @param mixed $message
     * @return boolean
     */
    public function accepts($message);

    /**
     * Create new message from array.
     *
     * @param array $messageData
     * @param string $messageClass
     * @return mixed
     */
    public function createFromArray(array $messageData, $messageClass);

    /**
     * Create array from message.
     *
     * @param mixed $message
     * @return array
     */
    public function toArray($message);
} 
