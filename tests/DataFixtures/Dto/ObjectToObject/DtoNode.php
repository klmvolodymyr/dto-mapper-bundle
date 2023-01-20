<?php

namespace Tests\DataFixtures\Dto\ObjectToObject;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;
use DtoMapperBundle\Annotation\MappingMeta\Strategy;

/**
 * @SourceClass()
 */
class DtoNode
{
    /**
     * @Strategy\GetterStrategy(method="getOptionA")
     */
    public int $optionA = 1;

    /**
     * @Strategy\GetterStrategy(method="getOptionB")
     */
    public int $optionB = 2;

    /**
     * @return string
     */
    public function getOptionA(): string
    {
        return \sprintf("Hello %s A!", $this->optionA);
    }

    /**
     * @return string
     */
    public function getOptionB(): string
    {
        return \sprintf("Hello %s B!", $this->optionB);
    }
}