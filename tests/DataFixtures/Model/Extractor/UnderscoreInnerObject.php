<?php

namespace Tests\DataFixtures\Model\Extractor;

use DtoMapperBundle\Annotation\MappingMeta\MappedClass;

/**
 * @MappedClass()
 */
class UnderscoreInnerObject
{
    public string $aOption = 'a';
    public string $bOption = 'b';
}