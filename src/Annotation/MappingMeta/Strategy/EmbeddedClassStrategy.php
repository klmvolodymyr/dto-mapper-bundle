<?php

namespace DtoMapperBundle\Annotation\MappingMeta\Strategy;

use Doctrine\Common\Annotations\Annotation;
use DataMapper\Strategy\CollectionStrategy;
use VKMapperBundle\Annotation\MappingMeta\Strategy\AbstractStrategy;
use VKMapperBundle\Annotation\MappingMeta\Strategy\ChainStrategyInterface;

/**
 * @Annotation
 * @Target({"PROPERTY", "ANNOTATION"})
 */
class EmbeddedClassStrategy extends AbstractStrategy implements ChainStrategyInterface
{
    /**
     * @Required
     * @var string
     */
    public $target;

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function getStrategyClassName(): string
    {
        return CollectionStrategy::class;
    }
}