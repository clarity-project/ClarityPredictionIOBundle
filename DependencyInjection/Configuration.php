<?php

namespace Clarity\PredictionIOBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('prediction_io');

        $rootNode
            ->beforeNormalization()
                ->ifTrue(function ($v) { return is_array($v) && array_key_exists('app_key', $v) && array_key_exists('api_url', $v); })
                ->then(function ($v) {
                    // we should put app_key & app_url as default client
                    foreach ($v as $key => $value) {
                        $v['default'][$key] = $value;
                        unset($v[$key]);
                    }

                    return $v;
                })
            ->end()
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->scalarNode('app_key')->isRequired()->end()
                    ->scalarNode('api_url')->defaultValue('http://localhost:8000')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
