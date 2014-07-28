<?php

namespace Detail\Bernard\Message;

use Bernard\Message as BernardMessage;
use Bernard\Message\DefaultMessage as BernardDefaultMessage;
use Bernard\Producer;

use RuntimeException;

class Messenger
{
    const MESSAGE_CLASS_KEY = 'message_class';
    const MESSAGE_KEY = 'message';

    /**
     * @var Producer
     */
    protected $producer;

    /**
     * @var MessageFactoryInterface
     */
    protected $messageFactory;

    /**
     * @return Producer
     */
    protected function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param Producer $producer
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    }

    /**
     * @return MessageFactoryInterface
     */
    public function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * @param MessageFactoryInterface $messageFactory
     */
    public function setMessageFactory(MessageFactoryInterface $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    public function __construct(Producer $producer, MessageFactoryInterface $messageFactory)
    {
        $this->setProducer($producer);
        $this->setMessageFactory($messageFactory);
    }

    /**
     * @param BernardMessage $message Message
     */
    public function produce(BernardMessage $message)
    {
        // Pushes the message to the queue
        $this->getProducer()->produce($message);
    }

    /**
     * Encode message for Bernard.
     *
     * @param mixed $message
     * @param string $queue
     * @throws RuntimeException
     * @return BernardDefaultMessage
     */
    public function encodeMessage($message, $queue)
    {
        $messageFactory = $this->getMessageFactory();

        if (!$this->messageFactory->accepts($message)) {
            throw new RuntimeException(
                sprintf(
                    '%s does not accept message of type "%s"',
                    get_class($messageFactory),
                    (is_object($message) ? get_class($message) : gettype($message))
                )
            );
        }

        return new BernardDefaultMessage(
            $queue,
            array(
                self::MESSAGE_CLASS_KEY => get_class($message),
                self::MESSAGE_KEY => $this->getMessageFactory()->toArray($message),
            )
        );
    }

    /**
     * Decode message from Bernard.
     *
     * @param BernardMessage $message
     * @return mixed
     * @throws RuntimeException
     */
    public function decodeMessage(BernardMessage $message)
    {
        if (!isset($message->{self::MESSAGE_CLASS_KEY})) {
            throw new RuntimeException(sprintf('Message is missing key "%s"', self::MESSAGE_CLASS_KEY));
        }

        if (!is_string($message->{self::MESSAGE_CLASS_KEY})) {
            throw new RuntimeException(
                sprintf('Message has invalid value for key "%s"; must be a string', self::MESSAGE_CLASS_KEY)
            );
        }

        if (!isset($message->{self::MESSAGE_KEY})) {
            throw new RuntimeException(sprintf('Message is missing key "%s"', self::MESSAGE_KEY));
        }

        if (!is_array($message->{self::MESSAGE_KEY})) {
            throw new RuntimeException(
                sprintf('Message has invalid value for key "%s"; must be an array', self::MESSAGE_KEY)
            );
        }

        return $this->getMessageFactory()->createFromArray(
            $message->{self::MESSAGE_KEY},
            $message->{self::MESSAGE_CLASS_KEY}
        );
    }
}
