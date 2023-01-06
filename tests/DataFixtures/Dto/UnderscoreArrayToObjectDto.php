<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedClass;
use Tests\DataFixtures\Model\Extractor\UnderscoreInnerObject;

/**
 * @DestinationClass(namingStrategies={
 *      @SnakeCaseNamingStrategy
 * })
 */
class UnderscoreArrayToObjectDto
{
    public string $aOption = 'a';
    public string $bOption = 'b';

    /**
     * @EmbeddedClass(target="Tests\DataFixtures\Model\Extractor\UnderscoreInnerObject")
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