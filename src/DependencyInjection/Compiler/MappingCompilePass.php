<?php

namespace DtoMapperBundle\DependencyInjection\Compiler;

use DataMapper\Strategy;
use DataMapper\Hydrator\ArrayCollectionHydrator;
use DataMapper\MappingRegistry;
use DataMapper\Type\TypeResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

use DataMapper\MapperInterface;
use DataMapper\NamingStrategy\SnakeCaseNamingStrategy;
use DataMapper\NamingStrategy\UnderscoreNamingStrategy;
use DataMapper\Type\TypeDict;
use DtoMapperBundle\Annotation\MappingMeta\NamingStrategy;
use DtoMapperBundle\Annotation\MappingMeta\NamingStrategy\NamingStrategyInterface;
use DtoMapperBundle\Hydrator\GeneratedHydratorCache;
use DtoMapperBundle\Annotation\MappingMetaReader;
use DtoMapperBundle\Annotation\MappingMeta\Strategy as MetaStrategy;
use DtoMapperBundle\Annotation\MappingMeta\Strategy\StrategyInterface as MetaStrategyInterface;

class MappingCompilePass implements CompilerPassInterface
{
    private const DTO_MAPPER_TAG = 'dto_mapper.annotated';
    private const DTO_MAPPER_HYDRATOR_TAG = 'dto_mapper.hydrator';

    /**
     * @throws \Exception
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        $this
            ->cleanupCache($container)
            ->registerHydrators($container)
            ->registerMapping($container);
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return \DtoMapperBundle\DependencyInjection\Compiler\MappingCompilePass
     */
    private function registerHydrators(ContainerBuilder $container): self
    {
        $hydrationRegistry = $container->getDefinition(MappingRegistry\HydratorRegistry::class);
        $baseHydrationTypes = TypeResolver::hydrationSupportedTypeSequence();

        foreach ($baseHydrationTypes as $type => $hydratorClass) {
            $hydrationRegistry->addMethodCall('registerHydrator', [new Reference($hydratorClass), $type]);
        }

        foreach ($container->findTaggedServiceIds(self::DTO_MAPPER_HYDRATOR_TAG) as $id => $tag) {
            if (!isset($tag['type'])) {
                throw new \DtoMapperBundle\Annotation\Exception\InvalidTypeException("You must register hydrator type for: $id");
            }

            $hydrationRegistry->addMethodCall('registerHydrator', [new Reference($id), $tag['type']]);
        }

        return $this;
    }

    /**
     * @throws \Exception
     *
     * @param ContainerBuilder $container
     *
     * @return MappingCompilePass
     */
    private function registerMapping(ContainerBuilder $container): self
    {
        $classMappingRegistry = $container->getDefinition(MappingRegistry\ClassMappingRegistry::class);

        /** @var \DtoMapperBundle\Annotation\MappingMetaReader $metaReader */
        foreach ($this->loadMapping($container) as $id => $metaReader) {

            if ($metaReader->skip()) {
                continue;
            }

            $classMappingRegistry->addMethodCall('registerMappingClass', [$id]);

            $this
                ->registerNaming($container, $metaReader, $id)
                ->registerRelations($container, $metaReader, $id)
                ->registerStrategies($container, $metaReader, $id)
                ->generateClassCache($container, $id);
        }

        return $this;
    }

    /**
     * @param ContainerBuilder  $container
     * @param MappingMetaReader $metaReader
     * @param string            $id
     *
     * @return MappingCompilePass
     */
    private function registerStrategies(ContainerBuilder $container, MappingMetaReader $metaReader, string $id): self
    {
        $strategyRegistry = $container->getDefinition(MappingRegistry\StrategyRegistry::class);
        /** @var MetaStrategy\StrategyInterface $strategy */
        foreach ($metaReader->getPropertiesStrategies() as $propertyName => $strategy) {

            if ($strategy->getSource()) {
                $strategyKey = TypeResolver::getStrategyType($strategy->getSource(), $id);
                $strategyRegistry->addMethodCall('registerPropertyStrategy',
                    [
                        $strategyKey,
                        $propertyName,
                        $this->createStrategyDefinition($container, $strategy),
                    ]
                );
            } else {
                $strategyKey = TypeResolver::getStrategyType($id, TypeDict::ALL_TYPE);
                $strategyRegistry->addMethodCall('registerPropertyStrategy',
                    [
                        $strategyKey,
                        $propertyName,
                        $this->createStrategyDefinition($container, $strategy),
                    ]
                );
            }
        }

        return $this;
    }

    /**
     * @param ContainerBuilder  $container
     * @param MappingMetaReader $reader
     * @param string            $id
     *
     * @return MappingCompilePass
     */
    private function registerRelations(ContainerBuilder $container, MappingMetaReader $reader, string $id): self
    {
        $strategyRegistry = $container->getDefinition(MappingRegistry\StrategyRegistry::class);

        /** @var \DtoMapperBundle\Annotation\MappingMeta\EmbeddedInterface $embedded */
        foreach ($reader->getRelationsProperties() as $propertyName => $embedded) {
            $strategy = new Definition(Strategy\CollectionStrategy::class, [ new Reference(MapperInterface::class), $embedded->getTarget(), $embedded->isMulti(), ]);

            if ($reader->isSource()) {
                $strategyKey = TypeResolver::getStrategyType($id, TypeDict::ALL_TYPE);
                $strategyRegistry->addMethodCall('registerPropertyStrategy', [ $strategyKey, $propertyName, $strategy, ]);
            }

            if ($reader->isDestination()) {
                $strategyKey = TypeResolver::getStrategyType(TypeDict::ARRAY_TYPE, $id);
                $strategyRegistry->addMethodCall('registerPropertyStrategy', [ $strategyKey, $propertyName, $strategy, ]);
                $strategyKey = TypeResolver::getStrategyType(TypeDict::ALL_TYPE, $id);
                $strategyRegistry->addMethodCall('registerPropertyStrategy', [ $strategyKey, $propertyName, $strategy, ]);
            }
        }

        return $this;
    }

    /**
     * @param ContainerBuilder  $container
     * @param MappingMetaReader $reader
     * @param string            $id
     *
     * @return MappingCompilePass
     */
    private function registerNaming(ContainerBuilder $container, MappingMetaReader $reader, string $id): self
    {
        $namingStrategyRegistry = $container->getDefinition(MappingRegistry\NamingStrategyRegistry::class);

        $hasDefaultSource = false;
        foreach ($reader->getSourceNamingStrategies() as $namingStrategy) {
            $hasDefaultSource = true;
            $definition = $this->createNamingStrategy($namingStrategy);
            $namingStrategyRegistry->addMethodCall('registerNamingStrategy', [ TypeResolver::getStrategyType($id, TypeDict::ALL_TYPE), $definition, ]);
        }

        if (false === $hasDefaultSource) {
            $namingStrategyRegistry->addMethodCall('registerNamingStrategy', [ TypeResolver::getStrategyType($id, TypeDict::ARRAY_TYPE),  new Definition(UnderscoreNamingStrategy::class), ]);
        }

        $hasDefaultDestination = false;
        /** @var \DtoMapperBundle\Annotation\MappingMeta\NamingStrategy\NamingStrategyInterface $namingStrategy */
        foreach ($reader->getDestinationNamingStrategies() as $namingStrategy) {
            $hasDefaultDestination = true;
            $definition = $this->createNamingStrategy($namingStrategy);
            $key = TypeResolver::getStrategyType(TypeDict::ALL_TYPE, $id);
            if ($namingStrategy->getSource()) {
                $key = TypeResolver::getStrategyType($namingStrategy->getSource(), $id);
            }

            $namingStrategyRegistry->addMethodCall('registerNamingStrategy', [ $key, $definition, ]);
        }

        if (false === $hasDefaultDestination) {
            $namingStrategyRegistry->addMethodCall('registerNamingStrategy', [ TypeResolver::getStrategyType(TypeDict::ARRAY_TYPE, $id),  new Definition(SnakeCaseNamingStrategy::class), ]);
        }

        return $this;
    }

    /**
     * @param ContainerBuilder      $container
     * @param \DtoMapperBundle\Annotation\MappingMeta\Strategy\StrategyInterface $strategy
     *
     * @return Definition
     */
    private function createStrategyDefinition(ContainerBuilder $container, MetaStrategyInterface $strategy): Definition
    {
        switch (\get_class($strategy)) {
            case MetaStrategy\GetterStrategy::class:
                return (
                new Definition(
                    Strategy\GetterStrategy::class,
                        [
                            $strategy->getMethod()
                        ]
                    )
                )->setLazy(true);
            case MetaStrategy\PropertyFormatterStrategy::class:
                return (
                new Definition(
                    Strategy\FormatterStrategy::class,
                        [
                            $strategy->getMethod()
                        ]
                    )
                )->setLazy(true);
            case MetaStrategy\XPathStrategy::class:
                return (
                new Definition(
                    Strategy\XPathGetterStrategy::class,
                        [
                            new Reference(ArrayCollectionHydrator::class),
                            $strategy->getXPath(),
                        ]
                    )
                )->setLazy(true);
            case MetaStrategy\StaticClosureStrategy::class:
                return (
                new Definition(
                    \DtoMapperBundle\StrategyAdapter\StaticClosureStrategyAdapter::class,
                        [
                            $strategy->getProvider(),
                            $strategy->getMethod(),
                        ]
                    )
                )->setLazy(true);
            case MetaStrategy\ChainStrategy::class:
                $args = [];
                foreach ($strategy->getList() as $singleStrategy) {
                    $args[] = $this->createStrategyDefinition($container, $singleStrategy);
                }

                return (
                new Definition(
                    Strategy\ChainStrategy::class,
                    [$args]
                    )
                )->setLazy(true);
            case MetaStrategy\ServiceClosureStrategy::class:
                return (
                new Definition(
                    \DtoMapperBundle\StrategyAdapter\ServiceClosureStrategyAdapter::class,
                        [
                            new Reference($strategy->getProvider()),
                            $strategy->getMethod(),
                        ]
                    )
                )->setLazy(true);
            case MetaStrategy\EmbeddedCollectionStrategy::class:
                return (
                new Definition(
                    Strategy\CollectionStrategy::class,
                        [
                            new Reference(MapperInterface::class),
                            $strategy->getTarget(),
                            $strategy->isMulti(),
                        ]
                    )
                )->setLazy(true);
            case MetaStrategy\EmbeddedClassStrategy::class:
                return (
                    new Definition(
                        Strategy\CollectionStrategy::class,
                        [
                            new Reference(MapperInterface::class),
                            $strategy->getTarget(),
                            false,
                        ]
                    )
                )->setLazy(true);
        }
    }

    /**
     * @param NamingStrategyInterface $namingStrategy
     *
     * @return Definition|Reference
     */
    private function createNamingStrategy(NamingStrategyInterface $namingStrategy)
    {
        if ($namingStrategy instanceof NamingStrategy\MapNamingStrategy) {
            $converted = [];
            $extracted = null;

            /** @var \DtoMapperBundle\Annotation\MappingMeta\NamingStrategy\Map $map */
            foreach ($namingStrategy->getConvert() as $map) {
                $converted[$map->getFrom()] = $map->getTo();
            }

            foreach ($namingStrategy->getExtract() as $map) {
                $extracted[$map->getFrom()] = $map->getTo();
            }

            return new Definition(
                $namingStrategy->getStrategyClassName(),
                [
                    $converted,
                    $extracted,
                ]
            );
        }

        return new Reference($namingStrategy->getStrategyClassName());
    }

    /**
     * @throws \Exception
     *
     * @param ContainerBuilder $container
     *
     * @return \Generator
     */
    private function loadMapping(ContainerBuilder $container): \Generator
    {
        foreach ($container->findTaggedServiceIds(self::DTO_MAPPER_TAG) as $id => $tag) {
            yield $id => $this->createReaderFor($container, $container->getDefinition($id)->getClass());
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $className
     *
     * @return MappingMetaReader
     * @throws \Exception
     */
    private function createReaderFor(ContainerBuilder $container, string $className): MappingMetaReader
    {
        return MappingMetaReader::createReader(
            $container->get(\DtoMapperBundle\Annotation\AnnotationReaderInterface::class),
            $className
        );
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return MappingCompilePass
     * @throws \Exception
     */
    private function cleanupCache(ContainerBuilder $container): self
    {
        $hydratorCache = $container->get(\DtoMapperBundle\Hydrator\GeneratedHydratorCache::class);
        $hydratorCache->cleanup();

        return $this;
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $id
     *
     * @return MappingCompilePass
     * @throws \Exception
     */
    private function generateClassCache(ContainerBuilder $container, string $id): self
    {
        $hydratorCache = $container->get(GeneratedHydratorCache::class);
        $hydratorCache->generateClass($id);

        return $this;
    }
}