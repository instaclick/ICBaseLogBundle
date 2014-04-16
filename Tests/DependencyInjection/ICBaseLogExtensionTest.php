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
     * Provide valid data for configuration test.
     *
     * @return array
     */
    public function provideValidData()
    {
        return array(
            array(
                array(
                    'log_requests' => 5,
                ),
            ),
        );
    }
}
