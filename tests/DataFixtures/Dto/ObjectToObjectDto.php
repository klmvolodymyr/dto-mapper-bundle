<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use Tests\DataFixtures\Model\Relations\MappedRelationsNodeInfo;

/**
 * @DestinationClass
 */
class ObjectToObjectDto
{
    /**
     * @var MappedRelationsNodeInfo
     */
    private $nodeA;

    /**
     * @var MappedRelationsNodeInfo
     * @Strategy\GetterStrategy(
     *     source="Tests\DataFixtures\Model\Relations\RootSource",
     *     method="getMe"
     * )
     */
    private $nodeB;

    /**
     * @Strategy\GetterStrategy(
     *     source="Tests\DataFixtures\Model\Relations\RootSource",
     *     method="getMe"
     * )
     */
    public $testMe;
}