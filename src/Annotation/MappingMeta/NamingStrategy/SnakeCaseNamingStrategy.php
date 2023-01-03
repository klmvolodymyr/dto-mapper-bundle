<?php

namespace DtoMapperBundle\Annotation\MappingMeta\NamingStrategy;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Annotation\Target({"ANNOTATION"})
 */
class SnakeCaseNamingStrategy extends AbstractNamingStrategy
{
    public function getStrategyClassName(): string
    {
        return \DataMapper\NamingStrategy\SnakeCaseNamingStrategy::class;
    }
}