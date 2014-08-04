<?php

namespace Detail\Bernard\Options\Message;

use Detail\Core\Options\AbstractOptions;

class MessengerOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $messageFactory;

    /**
     * @var string
     */
    protected $producer = 'Bernard\Producer';

    /**
     * @return string
     */
    public function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * @param string $messageFactory
     */
    public function setMessageFactory($messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    /**
     * @return string
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param string $producer
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    }
}
