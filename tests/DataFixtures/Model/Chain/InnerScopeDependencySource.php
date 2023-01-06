<?php

namespace Tests\DataFixtures\Model\Chain;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;

/**
 * @DestinationClass
 */
class InnerScopeDependencySource
{
    /**
     * @return int
     */
    public function getValue(): int
    {
        return 100;
    }
}