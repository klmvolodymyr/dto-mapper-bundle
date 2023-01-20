<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;
use Tests\DataFixtures\Model\Extractor\SnakeCaseInnerObject;
use DataMapper\NamingStrategy\SnakeCaseNamingStrategy;

/**
 * @SourceClass(namingStrategies={
 *     @SnakeCaseNamingStrategy
 * })
 */
class ObjectToSnakeCaseArrayDto
{
    public string $a_option = 'a';
    public string $b_option = 'b';

    /**
     * @var SnakeCaseInnerObject
     */
    public $c_option;

    /**
     * ObjectToSnakeCaseArray constructor.
     */
    public function __construct()
    {
        $this->c_option = new SnakeCaseInnerObject;
    }
}