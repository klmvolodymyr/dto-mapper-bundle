<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedClass;

/**
 * @DestinationClass()
 */
class MappedRelationsNodeDto
{
    public $propertyA;
    public $propertyB;
    public $propertyC;

    /**
     * @var MappedRelationsNodeDto
     *
     * @EmbeddedClass(target="\Tests\DataFixtures\Dto\MappedRelationsNodeDto")
     */
    public $nodeA;
}