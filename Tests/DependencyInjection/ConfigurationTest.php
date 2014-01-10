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
                        'log_requests' => 5,
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests' => 6,
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests' => 10,
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests' => 100,
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests' => 1,
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests' => 90,
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
                        'log_requests' => 0,
                    ),
                ),
            ),
            array(
                array(
                    'ic_base_log' => array(
                        'log_requests' => 101,
                    ),
                ),
            ),
        );
    }
}
