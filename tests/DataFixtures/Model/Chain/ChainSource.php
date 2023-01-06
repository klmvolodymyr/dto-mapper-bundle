<?php

namespace Tests\DataFixtures\Model\Chain;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;

/**
 * @SourceClass
 */
class ChainSource
{
    public int $baseValue = 1;

    /**
     * @Strategy\ChainStrategy(
     *     list={
     *          @Strategy\GetterStrategy(method="getBaseValue"),
     *          @Strategy\StaticClosureStrategy(
     *              provider="Tests\DataFixtures\Model\Chain\ChainClosureProvider",
     *              method="multiply2"
     *          ),
     *          @Strategy\ServiceClosureStrategy(
     *                  provider="Tests\DataFixtures\Model\Chain\ChainClosureProvider",
     *                  method="multiplyOnInnerValue"
     *          ),
     *          @Strategy\ServiceClosureStrategy(
     *                  provider="Tests\DataFixtures\Model\Chain\ChainClosureProvider",
     *                  method="multiplyOnInnerValue"
     *          )
     * })
     */
    public $chainMappedProperty;

    /**
     * @return int
     */
    public function getBaseValue(): int
    {
        return $this->baseValue;
    }
}