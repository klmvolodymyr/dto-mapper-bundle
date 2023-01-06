<?php

namespace Tests\DataFixtures\Model\Extractor;

use DtoMapperBundle\Annotation\MappingMeta\MappedClass;

/**
 * @MappedClass()
 */
class SnakeCaseInnerObject
{
    public string $a_option = 'a';
    public string $b_option = 'b';
}