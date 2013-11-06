<?php
/**
 * @copyright 2012 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;

use PhpAmqpLib\Message\AMQPMessage;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;

/**
 * Application log viewer
 *
 * @author Fabio B. Silva <fabios@nationalfibre.net>
 */
class LogViewerConsumer implements ConsumerInterface
{
    /**
     * @var \Symfony\Component\Console\Output\ConsoleOutputInterface
     */
    private $output;

    /**
     * @param \Symfony\Component\Console\Output\ConsoleOutputInterface $output
     */
    public function __construct(ConsoleOutputInterface $output = null)
    {
        $this->output = $output ?: new ConsoleOutput();
    }

    /**
     * {@inheritDoc}
     */
    public function execute(AMQPMessage $message)
    {
        $this->output->write($message->body);
    }
}
