<?php
namespace IC\Bundle\Base\LogBundle\Twig;

use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;

/**
 * A twig extension to provide a JavaScript error log
 * 
 * @author Kinn Coelho Julião <kinnj@nationalfibre.net>
 */
class JavaScriptErrorLogExtension extends \Twig_Extension
{
    /**
     * @var integer
     */
    protected $logRequest;

    /**
     * @var boolean
     */
    protected $kernelDebug;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Set the log request parameter
     *
     * @param integer $logRequest
     *
     * @throws \InvalidArgumentException
     */
    public function setLogRequest($logRequest)
    {
        if ( ! is_int($logRequest) || $logRequest < 1 || $logRequest > 100) {
            throw new \InvalidArgumentException("Parameter should be an integer between 1 and 100");
        }

        $this->logRequest = $logRequest;
    }

    /**
     * Set the kernel debug parameter
     *
     * @param boolean $kernelDebug
     *
     * @throws \InvalidArgumentException
     */
    public function setKernelDebug($kernelDebug)
    {
        if ( ! is_bool($kernelDebug)) {
            throw new \InvalidArgumentException("Parameter should be bool");
        }

        $this->kernelDebug = $kernelDebug;
    }

    /**
     * Set the twig environment
     *
     * @param \Twig_Environment $twig
     */
    public function setTwig(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'javascript_error_log',
                array($this, 'renderLog'),
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * Render the JavaScript partial if necessary
     *
     * @param string $targetPath the URL to send the error log
     *
     * @return string
     */
    public function renderLog($targetPath)
    {
        $averageKey = mt_rand(1, 100);

        if ($this->kernelDebug || $averageKey <= $this->logRequest) {
            return $this->twig
                ->render(
                    "ICBaseLogBundle:Log:javaScriptErrorLog.html.twig",
                    array("targetPath" => $targetPath)
                );
        }

        return;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ic_base_log.twig.extension.javascript_error_log_extension';
    }
}
