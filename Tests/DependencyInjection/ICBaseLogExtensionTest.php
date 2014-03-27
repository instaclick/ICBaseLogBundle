<?php
/**
 * @copyright 2013 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Tests\DependencyInjection;

use IC\Bundle\Base\LogBundle\DependencyInjection\ICBaseLogExtension;
use IC\Bundle\Base\TestBundle\Test\DependencyInjection\ExtensionTestCase;

/**
 * Test for ICBaseLogExtension
 *
 * @group ICBaseLogBundle
 * @group Unit
 * @group DependencyInjection
 *
 * @author John Zhang <johnz@nationalfibre.net>
 * @author Paul Munson <pmunson@nationalfibre.net>
 */
class ICBaseLogExtensionTest extends ExtensionTestCase
{
    /**
     * Test valid configuration
     *
     * @param array $configuration
     *
     * @dataProvider provideValidData
     */
    public function testValidConfiguration($configuration)
    {
        $loader = new ICBaseLogExtension();

        $this->load($loader, $configuration);
    }

    /**
     * Test invalid AMQP log level throws exception
     *
     * @param array $configuration
     *
     * @dataProvider provideInvalidData
     *
     * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testInvalidAmqpLogLevelThrowsException($configuration)
    {
        $loader = new ICBaseLogExtension();

        $this->load($loader, $configuration);
    }

    /**
     * Provide valid data for configuration test.
     *
     * @return array
     */
    public function provideValidData()
    {
        return array(
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'debug',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'info',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'notice',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'warning',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'error',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'critical',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'alert',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'emergency',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
        );
    }

    /**
     * Provide invalid data for configuration test.
     *
     * @return array
     */
    public function provideInvalidData()
    {
        return array(
            array(
                array(
                    'log_requests'       => 5,
                    'amqp_log_level'     => 'this_log_level_is_invalid',
                    'amqp_exchange_name' => 'affiliate_log_dev',
                ),
            ),
        );
    }
}
