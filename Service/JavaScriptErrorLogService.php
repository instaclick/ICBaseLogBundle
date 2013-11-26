<?php
/**
 * @copyright 2012 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Service;

use Psr\Log\LoggerInterface;

/**
 * Monolog service for JavaScript errors
 *
 * @author Kinn Coelho Julião <kinnj@nationalfibre.net>
 */
class JavaScriptErrorLogService
{
    const MESSAGE = "File: {file}, Line: {line}, Message: {message}, URL: {url}, User Agent: {userAgent}";

    /**
     * The RabbitMQ producer.
     *
     * @var \Psr\Log\LoggerInterface $logger
     */
    private $logger;

    /**
     * Define the Logger
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * write the log
     *
     * @param array $parameterList
     */
    public function write($parameterList)
    {
        $this->logger->warning(strtr(self::MESSAGE, $parameterList));
    }
}
