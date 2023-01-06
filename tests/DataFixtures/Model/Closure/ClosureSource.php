<?php

namespace Tests\DataFixtures\Model\Closure;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;

/**
 * @SourceClass
 */
class ClosureSource
{
    /**
     * @var int
     */
    public int $optionA = 12;

    /**
     * @var int
     */
    public int $optionB = 13;

    /**
     * @Strategy\ServiceClosureStrategy(
     *     provider="Tests\DataFixtures\Model\Closure\ClosureProvider",
     *     method="getClosure"
     * )
     */
    public $myValue;

    /**
     * @Strategy\StaticClosureStrategy(
     *     provider="Tests\DataFixtures\Model\Closure\ClosureProvider",
     *     method="getStaticClosure"
     * )
     */
    public $myValueB;

    /**
     * @return int
     */
    public function getSum(): int
    {
        return $this->optionA + $this->optionB;
    }
}