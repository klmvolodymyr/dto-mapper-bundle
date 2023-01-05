<?php

namespace DtoMapperBundle\Annotation\MappingMeta\Strategy;

use DtoMapperBundle\Annotation\MappingMeta\Strategy\StrategyInterface;

abstract class AbstractStrategy implements StrategyInterface
{
    public ?string $source = null;

    public function getSource(): ?string
    {
        return $this->source;
    }
}