<?php

namespace DtoMapperBundle\Annotation\MappingMeta\NamingStrategy;

abstract class AbstractNamingStrategy implements NamingStrategyInterface
{
    public $source;

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }
}