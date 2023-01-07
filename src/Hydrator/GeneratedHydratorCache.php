<?php

namespace DtoMapperBundle\Hydrator;

use DataMapper\Hydrator\HydratedClassesFactory;
use Symfony\Component\Filesystem\Filesystem;

class GeneratedHydratorCache
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $cacheDir;

    /**
     * @var HydratedClassesFactory
     */
    private $hydratedClassesFactory;

    public function __construct(Filesystem $filesystem, HydratedClassesFactory $hydratedClassesFactory, string $cacheDir)
    {
        $this->cacheDir = $cacheDir;
        $this->filesystem = $filesystem;
        $this->hydratedClassesFactory = $hydratedClassesFactory;
    }

    public function createStorage(): void
    {
        $this->filesystem->mkdir($this->cacheDir);
    }

    public function cleanup(): void
    {
        $this->filesystem->remove($this->cacheDir);
        $this->createStorage();
    }

    public function generateClass(string $className): void
    {
        $this->hydratedClassesFactory->extractHydratedClass($className);
    }
}