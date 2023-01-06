<?php

namespace Tests\DataFixtures\Dto\ObjectToObject;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedClass;

/**
 * @DestinationClass()
 */
class DtoToObject
{
    /**
     * @var ObjectNode
     * @EmbeddedClass(target="Tests\DataFixtures\Dto\ObjectToObject\ObjectNode")
     */
    public $nodeA;
}