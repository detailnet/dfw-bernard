<?php

namespace Detail\Bernard\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\ColorInterface as ConsoleColor;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LogLevel;

use Application\Log\LoggerAwareTrait;

use RuntimeException;

use Bernard\Consumer;
use Bernard\QueueFactory;

class ConsumerController extends AbstractActionController implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    protected $consumer = null;

    /**
     * @var
     */
    protected $queues = null;

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

        if ($isVerbose) {
            $console->writeLine(
                sprintf('Consuming messages in queue "%s"', $queueName), ConsoleColor::LIGHT_BLUE
            );
        }

        /** @todo Log processing of each message when verbose */

        $consumer = $this->getConsumer();
        $consumer->consume(
            $this->getQueues()->create($queueName),
            array(
                /** @todo Make configurable */
                'max-runtime' => 10,
            )
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
