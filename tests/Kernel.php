<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use DtoMapperBundle\DtoMapperBundle;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getCacheDir(): string
    {
        return \sprintf(
            "%s/var/cache/%s",
            $this->getProjectDir(),
            $this->environment
        );
    }

    public function getLogDir(): string
    {
        return \sprintf(
            "%s/var/log",
            $this->getProjectDir()
        );
    }

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new DtoMapperBundle(),
        ];
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $loader->load(\sprintf(
            "%s/tests/Resource/config/test_services.yaml",
                $this->getProjectDir()
        ));
        $container->setParameter('kernel.secret', 'none');
    }
}