<?php

namespace Tests\DataFixtures\Dto\ObjectToObject;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedClass;

/**
 * @DestinationClass()
 */
class ArrayToDto
{
    /**
     * @var DtoNode
     * @EmbeddedClass(target="Tests\DataFixtures\Dto\ObjectToObject\DtoNode")
     */
    public $nodeA;
}