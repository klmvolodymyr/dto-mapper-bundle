<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;
use Tests\DataFixtures\Model\Extractor\UnderscoreInnerObject;

/**
 * @SourceClass()
 */
class ObjectToUnderscoreArrayDto
{
    public string $aOption = 'a';
    public string $bOption = 'b';

    /**
     * @var UnderscoreInnerObject
     */
    public $cOption;

    /**
     * ObjectToUnderscoreArray constructor.
     */
    public function __construct()
    {
        $this->cOption = new UnderscoreInnerObject();
    }
}