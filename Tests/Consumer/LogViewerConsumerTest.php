<?php
/**
 * @copyright 2013 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Tests\Consumer;

use IC\Bundle\Base\TestBundle\Test\TestCase;
use IC\Bundle\Base\LogBundle\Consumer\LogViewerConsumer;

/**
 * Test cases for {@see \IC\Bundle\Base\LogBundle\Consumer\LogViewerConsumer}.
 *
 * @group Log
 * @group Unit
 *
 * @author Fabio B. Silva <fabios@nationalfibre.net>
 */
class LogViewerConsumerTest extends TestCase
{
    /**
     * @var \IC\Bundle\Base\LogBundle\Consumer\LogViewerConsumer
     */
    private $consumer;

    /**
     * @var \Symfony\Component\Console\Output\ConsoleOutputInterface
     */
    private $output;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->output   = $this->createMockProducer();
        $this->consumer = new LogViewerConsumer($this->output);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function createMockProducer()
    {
        return $this->getMock('Symfony\Component\Console\Output\ConsoleOutput', array('write'));
    }

    /**
     * Test execute write message
     */
    public function testHandleShouldPublishMessage()
    {
        $body    = '[2013-07-25 15:54:03] event.DEBUG: Notified event "kernel.response" ...';
        $message = $this->getMock('PhpAmqpLib\Message\AMQPMessage');

        $message->body = $body;

        $this->output->expects($this->once())
            ->method('write')
            ->with($body);

        $this->consumer->execute($message);
    }
}
