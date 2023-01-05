<?php

namespace DtoMapperBundle\Annotation\MappingMeta\Strategy;

use DataMapper\Strategy\XPathGetterStrategy;
use DtoMapperBundle\Annotation\MappingMeta\Strategy\AbstractStrategy;
use DtoMapperBundle\Annotation\MappingMeta\Strategy\ChainStrategyInterface;

/**
 * @Annotation
 * @Annotation\Target({"PROPERTY", "ANNOTATION"})
 */
class XPathStrategy extends AbstractStrategy implements ChainStrategyInterface
{
    /**
     * @Required
     * @var string
     */
    public $xPath;

    /**
     * @return string
     */
    public function getXPath(): string
    {
        return $this->xPath;
    }

    /**
     * @return string
     */
    public function getStrategyClassName(): string
    {
        return XPathGetterStrategy::class;
    }
}