<?php

namespace Clarity\PredictionIOBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class ClientCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $configuration = $container->getParameter('prediction_io.configuration');

        $container
            ->setDefinition('prediction_io.client_factory', new Definition(
                $container->getParameter('prediction_io.factory.class')
            ))
        ;

        foreach ($configuration as $name => $parameters) {
            $container
                ->setDefinition('prediction_io.' . $name . '_client', new Definition(
                    $container->getParameter('prediction_io.factory.class'), array(
                        array('appkey' => $parameters['app_key'], 'appurl' => $parameters['app_url'])
                    )
                ))
                ->setFactoryService('prediction_io.client_factory')
                ->setFactoryMethod('factory')
            ;
        }
    }
}