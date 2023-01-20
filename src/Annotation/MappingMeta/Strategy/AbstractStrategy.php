<?php

namespace DtoMapperBundle\Annotation\MappingMeta\Strategy;

abstract class AbstractStrategy implements StrategyInterface
{
    public ?string $source = null;

    public function getSource(): ?string
    {
        return $this->source;
    }
}