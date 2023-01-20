<?php

namespace DtoMapperBundle\Annotation\MappingMeta\Strategy;

use Doctrine\Common\Annotations\Annotation;
use DtoMapperBundle\Annotation\MappingMeta\Strategy\AbstractStrategy;
use DtoMapperBundle\Annotation\MappingMeta\Strategy\StrategyInterface;

/**
 * @Annotation
 * @Annotation\Target({"PROPERTY", "ANNOTATION"})
 */
class ChainStrategy  extends AbstractStrategy
{
    /**
     * @Required
     * @var array<\DtoMapperBundle\Annotation\MappingMeta\Strategy\ChainStrategyInterface>
     */
    public $list = [];

    /**
     * @return StrategyInterface[]
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @return string
     */
    public function getStrategyClassName(): string
    {
        return \DataMapper\Strategy\ChainStrategy::class;
    }
}