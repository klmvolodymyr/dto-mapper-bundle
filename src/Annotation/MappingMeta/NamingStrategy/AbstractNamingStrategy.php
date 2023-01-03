<?php

namespace DtoMapperBundle\Annotation\MappingMeta\NamingStrategy;

use Doctrine\Common\Annotations\Annotation;

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