<?php

namespace IC\Bundle\Base\LogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 * 
 * @author Fabio B. Silva <fabios@nationalfibre.net>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('ic_base_log');

        $rootNode
            ->children()
                ->integerNode('log_requests')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->min(0)
                    ->max(100)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
