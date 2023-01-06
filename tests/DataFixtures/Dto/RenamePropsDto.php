<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;

/**
 * @DestinationClass(namingStrategies={
 *     @MapNamingStrategy(
 *      convert={
 *          @Map(from="some_A", to="propA"),
 *          @Map(from="some_B", to="propB"),
 *          @Map(from="some_C", to="propC")
 *     }
 *  )
 * })
 */
class RenamePropsDto
{
    public int $propA = 1;
    public int $propB = 2;
    public int $propC = 3;
}