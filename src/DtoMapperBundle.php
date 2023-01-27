<?php

namespace DtoMapperBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use DtoMapperBundle\DependencyInjection\Compiler\MappingCompilePass;
use DtoMapperBundle\DependencyInjection\MapperBundleExtension;

class DtoMapperBundle  extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $container->registerExtension(new MapperBundleExtension());
        $container->addCompilerPass(new MappingCompilePass());
    }
}