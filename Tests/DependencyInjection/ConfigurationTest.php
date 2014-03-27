<?php
/**
 * @copyright 2013 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Tests\DependencyInjection;

use IC\Bundle\Base\LogBundle\DependencyInjection\Configuration;
use IC\Bundle\Base\TestBundle\Test\DependencyInjection\ConfigurationTestCase;

/**
 * Test for Configuration
 *
 * @group ICBaseLogBundle
 * @group Unit
 * @group DependencyInjection
 *
 * @author Kinn Coelho Julião <kinnj@nationalfibre.net>
 * @author Paul Munson <pmunson@nationalfibre.net>
 */
class ConfigurationTest extends ConfigurationTestCase
{
    /**
     * Test valid data.
     *
     * @param array $config
     *
     * @dataProvider provideValidData
     */
    public function testShouldConfigureValidData($config)
    {
        $configuration = $this->processConfiguration(new Configuration(), $config);

        $this->assertEquals($config['ic_base_log']['log_requests'], $configuration['log_requests']);
        $this->assertEquals($config['ic_base_log']['amqp_log_level'], $configuration['amqp_log_level']);
        $this->assertEquals($config['ic_base_log']['amqp_exchange_name'], $configuration['amqp_exchange_name']);
    }

    /**
     * Test invalid data.
     *
     * @param array $config
     *
     * @dataProvider      provideInvalidData
     * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testShouldThrowExceptionForInvalidData($config)
    {
        $configuration = $this->processConfiguration(new Configuration(), $config);
    }

    /**
     * Provide valid data.
     *
     * @return array
     */
    public function provideValidData()
    {
        return array(
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 5,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 6,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 10,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 100,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 1,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 90,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests' => 95,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
        );
    }

    /**
     * Provide invalid data.
     *
     * @return array
     */
    public function provideInvalidData()
    {
        return array(
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 0,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests'       => 101,
                        'amqp_log_level'     => 'critical',
                        'amqp_exchange_name' => 'affiliate_log_dev',
                    ),
                ),
            ),
        );
    }
}
