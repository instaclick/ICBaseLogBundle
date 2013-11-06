<?php
/**
 * @copyright 2012 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Handler;

use Monolog\Handler\AbstractProcessingHandler;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

/**
 * Monolog handler for RabbitMqBundle
 *
 * @author Fabio B. Silva <fabios@nationalfibre.net>
 */
class RabbitMqHandler extends AbstractProcessingHandler
{
    /**
     * The RabbitMQ producer.
     *
     * @var \OldSound\RabbitMqBundle\RabbitMq\Producer $producer
     */
    private $producer;

    /**
     * Define the RabbitMQ producer.
     *
     * @param \OldSound\RabbitMqBundle\RabbitMq\Producer $producer The rabbitmq producer.
     */
    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record)
    {
        $routing = strtolower($record['level_name'] . '.' . $record['channel']);

        $this->producer->publish($record["formatted"], $routing);
    }
}
