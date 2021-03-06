<?php

namespace Tui\SessionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tui_session');

        $rootNode
            ->children()
            ->integerNode('session_timeout')->defaultValue(3600)->end()
            ->scalarNode('redirect_to')->defaultNull()->end()
            ->scalarNode('expired_response')->defaultNull()->end()
            ->end();


        return $treeBuilder;
    }
}
