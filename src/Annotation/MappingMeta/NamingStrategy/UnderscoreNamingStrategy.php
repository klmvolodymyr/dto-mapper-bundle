<?php

namespace DtoMapperBundle\Annotation\MappingMeta\NamingStrategy;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Annotation\Target({"ANNOTATION"})
 */
class UnderscoreNamingStrategy extends AbstractNamingStrategy
{
    /**
     * @return string
     */
    public function getStrategyClassName(): string
    {
        return \DataMapper\NamingStrategy\UnderscoreNamingStrategy::class;
    }
}