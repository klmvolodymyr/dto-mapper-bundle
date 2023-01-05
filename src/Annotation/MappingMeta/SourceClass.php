<?php

namespace DtoMapperBundle\Annotation\MappingMeta;

use Doctrine\Common\Annotations\Annotation;

/**
 * Use this mapping to customize fields naming.
 *
 * @Annotation
 * @Annotation\Target("CLASS")
 */
class SourceClass
{
    /**
     * @var array<\DtoMapperBundle\Annotation\MappingMeta\NamingStrategy\AbstractNamingStrategy>
     */
    public $namingStrategies;

    /**
     * @return \DtoMapperBundle\Annotation\MappingMeta\NamingStrategy\NamingStrategyInterface[]|null
     */
    public function getNamingStrategies(): ?array
    {
        return $this->namingStrategies;
    }
}