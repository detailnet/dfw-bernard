<?php

namespace Detail\Bernard\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\ColorInterface as ConsoleColor;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LogLevel;

use Detail\Log\Service\LoggerAwareTrait;

use RuntimeException;

use Bernard\Consumer;
use Bernard\QueueFactory;

class ConsumerController extends AbstractActionController implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    const OPTION_MAX_RUNTIME = 'max_runtime';

    /**
     * @var \Bernard\Consumer
     */
    protected $consumer;

    /**
     * @var array
     * @todo Make configurable
     */
    protected $consumerOptions = array(
//        self::OPTION_MAX_RUNTIME => 10
    );

    /**
     * @var QueueFactory
     */
    protected $queues;

    public function getConsumerOption($name, $default = null)
    {
        $options = $this->getConsumerOptions();

        /** @var ConsoleRequest $request */
        $request = $this->getRequest();
        $value = $request->getParam($name);

        if ($value === null) {
            $value = array_key_exists($name, $options) ? $options[$name] : $default;
        }

        return $value;
    }

    /**
     * @return array
     */
    public function getConsumerOptions()
    {
        return $this->consumerOptions;
    }

    /**
     * @param array $consumerOptions
     */
    public function setConsumerOptions(array $consumerOptions)
    {
        $this->consumerOptions = $consumerOptions;
    }

    public function __construct(Consumer $consumer, QueueFactory $queues)
    {
        $this->consumer = $consumer;
        $this->queues = $queues;
    }

    /**
     * Consume queue (run receivers).
     *
     * @throws RuntimeException When action is not called from a console
     * @return void
     */
    public function consumeAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof ConsoleRequest){
            throw new RuntimeException('You can only use this action from a console');
        }

        $console = $this->getServiceLocator()->get('console');

        if (!$console instanceof Console) {
            throw new RuntimeException('Cannot obtain console adapter. Are we running in a console?');
        }

        $queueName = $request->getParam('queue');
        $isVerbose = $request->getParam('verbose', false) || $request->getParam('v', false);

        $this->log(
            sprintf('Started consuming messages in queue "%s"', $queueName), LogLevel::INFO
        );

        if ($isVerbose) {
            $console->writeLine(
                sprintf('Consuming messages in queue "%s"', $queueName), ConsoleColor::LIGHT_BLUE
            );
        }

        /** @todo Output processing of each message when verbose */

        $consumerOptions = array();
        $maxRuntime = $this->getConsumerOption(self::OPTION_MAX_RUNTIME);

        if ($maxRuntime !== null) {
            $consumerOptions['max-runtime'] = (int) $maxRuntime;
        }

        $consumer = $this->getConsumer();
        $consumer->consume($this->getQueues()->create($queueName), $consumerOptions);

        $this->log(
            sprintf('Ended consuming messages in queue "%s"', $queueName), LogLevel::NOTICE
        );
    }

    protected function getConsumer()
    {
        return $this->consumer;
    }

    protected function getQueues()
    {
        return $this->queues;
    }
}
