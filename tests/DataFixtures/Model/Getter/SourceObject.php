<?php

namespace Tests\DataFixtures\Model\Getter;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;

/**
 * @SourceClass
 */
class SourceObject
{
    public int $a = 100;
    public int $b = 200;
    public int $c = 300;

    /**
     * @Strategy\GetterStrategy(method="getSum")
     */
    public $sum;

    /**
     * @Strategy\PropertyFormatterStrategy(method="getFormattedValue")
     */
    public int $formatted = 100;

    public function getSum(): int
    {
        return $this->a + $this->b + $this->c;
    }

    public function getFormattedValue(int $value): string
    {
        return \sprintf("%d- formatted", $value);
    }
}