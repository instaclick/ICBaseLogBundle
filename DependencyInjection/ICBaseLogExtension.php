<?php

namespace IC\Bundle\Base\LogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;
use Monolog\Logger;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @author Fabio B. Silva <fabios@nationalfibre.net>
 * @author Paul Munson <pmunson@nationalfibre.net>
 */
class ICBaseLogExtension extends Extension
{
    /**
     * Load and validate configuration parameters
     *
     * @param array                                                   $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @throws \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('ic_base_log.config.log_requests', $config['log_requests']);
    }
}
