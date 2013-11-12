<?php

namespace Clarity\PredictionIOBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Clarity\PredictionIOBundle\DependencyInjection\PredictionIOExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Clarity\PredictionIOBundle\DependencyInjection\Compiler\ClientCompilerPass;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class ClarityPredictionIOBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->registerExtension(new PredictionIOExtension());
        $container->addCompilerPass(new ClientCompilerPass());
    }
}