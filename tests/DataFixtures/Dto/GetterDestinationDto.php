<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;

/**
 * @DestinationClass
 */
class GetterDestinationDto
{
    public $sum;
    public int $innerValue = 13;
}