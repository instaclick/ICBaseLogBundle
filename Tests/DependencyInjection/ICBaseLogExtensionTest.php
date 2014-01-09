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
 */
class ICBaseLogExtensionTest extends ExtensionTestCase
{
    /**
     * Test configuration
     */
    public function testConfiguration()
    {
        $loader = new ICBaseLogExtension();

        $this->load($loader, array());
    }
}
