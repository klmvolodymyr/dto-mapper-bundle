<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;

use DtoMapperBundle\Annotation\MappingMeta\EmbeddedClass;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedCollection;
use Tests\DataFixtures\Model\Relations\MappedRelationsNodeInfo;

/**
 * @DestinationClass(namingStrategies={
 *    @SnakeCaseNamingStrategy
 * })
 */
class MappedRelationsRootDto
{
    /**
     * @var MappedRelationsNodeDto
     * @EmbeddedClass(target="Tests\DataFixtures\Dto\MappedRelationsNodeDto")
     */
    public $nodeA;

    /**
     * @var MappedRelationsNodeDto
     * @EmbeddedClass(target="Tests\DataFixtures\Dto\MappedRelationsNodeDto")
     */
    public $nodeB;

    /**
     * @var MappedRelationsNodeInfo
     *
     * @EmbeddedCollection(target="Tests\DataFixtures\Model\Relations\MappedRelationsNodeInfo")
     */
    public $event = [];
}