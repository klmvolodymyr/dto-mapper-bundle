<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\Strategy;
use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;

/**
 * @DestinationClass
 */
class ObjectToObjectDto
{
    public $nodeA;

    /**
     * @Strategy\GetterStrategy(
     *     source="\Tests\DataFixtures\Model\Relations\RootSource",
     *     method="getMe"
     * )
     */
    public $nodeB;

    /**
     * @Strategy\GetterStrategy(
     *     source="\Tests\DataFixtures\Model\Relations\RootSource",
     *     method="getMe"
     * )
     */
    public $testMe;
}