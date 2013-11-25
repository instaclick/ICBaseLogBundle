<?php
/**
 * @copyright 2013 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Tests\Twig;

use IC\Bundle\Base\LogBundle\Twig\JavaScriptErrorLogExtension;
use IC\Bundle\Base\TestBundle\Test\TestCase;

/**
 * Test for Configuration
 *
 * @group ICBaseLogBundle
 * @group Unit
 * @group DependencyInjection
 *
 * @author Kinn Coelho Julião <kinnj@nationalfibre.net>
 */
class JavaScriptErrorLogExtensionTest extends TestCase
{
    /**
     * @var \IC\Bundle\Base\LogBundle\Twig\JavaScriptErrorLogExtension
     */
    private $javaScriptErrorLogExtension;

    /**
     * Create the main test object
     */
    protected function setUp()
    {
        $this->javaScriptErrorLogExtension = new JavaScriptErrorLogExtension();
        $this->javaScriptErrorLogExtension->setLogRequest(5);
        $this->javaScriptErrorLogExtension->setKernelDebug(true);
        $this->javaScriptErrorLogExtension->setTwig($this->createTwigMock());
    }

    /**
     * Test the getName public method
     */
    public function testShouldGetName()
    {
        $this->assertEquals(
            'ic_base_log.twig.extension.javascript_error_log_extension',
            $this->javaScriptErrorLogExtension->getName()
        );
    }

    /**
     * Test the getFunctions method
     */
    public function testShouldGetFunctions()
    {
        $twigSimpleFunction = $this->javaScriptErrorLogExtension->getFunctions();

        $this->assertEquals('javascript_error_log', $twigSimpleFunction[0]->getName());
    }

    /**
     * Test the renderLog method
     */
    public function testShouldRenderLog()
    {
        $expectedResult = "<script>alert('a');</script>";
        $actualResult   = $this->javaScriptErrorLogExtension->renderLog("http://foo/bar");

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test the kernelDebug method with invalid data
     *
     * @param mixed $invalidData
     *
     * @dataProvider provideInvalidKernelDebugData
     *
     * @expectedException \InvalidArgumentException
     */
    public function testShouldNotSetInvalidKernelDebug($invalidData)
    {
        $this->javaScriptErrorLogExtension->setKernelDebug($invalidData);
    }

    /**
     * Test the kernelDebug method with valid data
     *
     * @param bool $validData
     *
     * @dataProvider provideValidKernelDebugData
     */
    public function testShouldSetValidKernelDebug($validData)
    {
        $this->javaScriptErrorLogExtension->setKernelDebug($validData);
    }

    /**
     * Test the setLogRequest method with invalid data
     *
     * @param mixed $invalidData
     *
     * @dataProvider provideInvalidLogRequestData
     *
     * @expectedException \InvalidArgumentException
     */
    public function testShouldNotSetInvalidLogRequest($invalidData)
    {
        $this->javaScriptErrorLogExtension->setLogRequest($invalidData);
    }

    /**
     * Test the setLogRequest method with valid data
     *
     * @param mixed $validData
     *
     * @dataProvider provideValidLogRequestData
     */
    public function testShouldSetValidLogRequest($validData)
    {
        $this->javaScriptErrorLogExtension->setLogRequest($validData);
    }

    /**
     * Provide invalid data
     *
     * @return array
     */
    public function provideInvalidLogRequestData()
    {
        return array(
            array('manolo'),
            array(0),
            array(-1),
            array(101),
            array(false),
            array(new \stdClass),
        );
    }

    /**
     * Provide invalid data
     *
     * @return array
     */
    public function provideInvalidKernelDebugData()
    {
        return array(
            array('manolo'),
            array(0),
            array(-1),
            array(101),
            array(new \stdClass),
            array(null),
        );
    }

    /**
     * Provide valid data
     *
     * @return array
     */
    public function provideValidLogRequestData()
    {
        $invalidData = array();

        for ($i = 1; $i <= 100; $i++) {
            $invalidData[] = array($i);
        }

        return $invalidData;
    }

    /**
     * Provide valid data
     *
     * @return array
     */
    public function provideValidKernelDebugData()
    {
        return array(
            array(true),
            array(false),
        );
    }

    /**
     * Create a twig mock
     *
     * @return \Twig_Environment $twigMock
     */
    private function createTwigMock()
    {


        $twigMock = $this->createMock('Twig_Environment');
        $twigMock->expects($this->any())
            ->method('render')
            ->will(
                $this->returnValue("<script>alert('a');</script>")
            );

        return $twigMock;
    }
}
