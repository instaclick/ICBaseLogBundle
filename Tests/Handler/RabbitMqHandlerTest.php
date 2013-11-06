<?php
/**
 * @copyright 2013 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Tests\Handler;

use Monolog\Logger;

use IC\Bundle\Base\TestBundle\Test\TestCase;
use IC\Bundle\Base\LogBundle\Handler\RabbitMqHandler;

/**
 * Test cases for {@see \IC\Bundle\Base\LogBundle\Handler\RabbitMqHandler}.
 *
 * @group Log
 * @group Unit
 *
 * @author Fabio B. Silva <fabios@nationalfibre.net>
 */
class RabbitMqHandlerTest extends TestCase
{
    /**
     * @var \IC\Bundle\Base\LogBundle\Handler\RabbitMqHandler
     */
    private $handler;

    /**
     * @var \OldSound\RabbitMqBundle\RabbitMq\Producer
     */
    private $producer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->producer = $this->createMock('OldSound\RabbitMqBundle\RabbitMq\Producer');
        $this->handler  = new RabbitMqHandler();

        $this->handler->setProducer($this->producer);
    }

    /**
     * Test Construct Defaults
     */
    public function testConstructDefaults()
    {
        $this->assertEquals(Logger::DEBUG, $this->handler->getLevel());
        $this->assertEquals(true, $this->handler->getBubble());
    }

    /**
     * Test handle publish message
     */
    public function testHandleShouldPublishMessage()
    {
        $record = array(
            'message'    => 'test',
            'channel'    => 'test',
            'extra'      => array(),
            'level'      => Logger::WARNING,
            'level_name' => Logger::getLevelName(Logger::WARNING),
            'context'    => array('data' => new \stdClass, 'foo'=> 34),
            'datetime'   => \DateTime::createFromFormat('U.u', sprintf('%.6F', microtime(true))),
        );

        $format   = '[%s] test.WARNING: test {"data":"[object] (stdClass: {})","foo":34} []' . PHP_EOL;
        $expected = sprintf($format, $record['datetime']->format('Y-m-d H:i:s'));

        $this->producer->expects($this->once())
            ->method('publish')
            ->with($this->equalTo($expected));

        $this->handler->handle($record);
    }

    /**
     * Test handle publish using log routing key
     */
    public function testHandleShouldUseLogLevelAndChannelAsRoutingMessage()
    {
        $record = array(
            'message'    => 'test',
            'channel'    => 'test',
            'context'    => array(),
            'extra'      => array(),
            'level'      => Logger::INFO,
            'level_name' => Logger::getLevelName(Logger::INFO),
            'datetime'   => \DateTime::createFromFormat('U.u', sprintf('%.6F', microtime(true))),
        );

        $format   = '[%s] test.INFO: test [] []' . PHP_EOL;
        $expected = sprintf($format, $record['datetime']->format('Y-m-d H:i:s'));

        $this->producer->expects($this->once())
            ->method('publish')
            ->with($this->equalTo($expected), $this->equalTo('info.test'));

        $this->handler->handle($record);
    }
}
