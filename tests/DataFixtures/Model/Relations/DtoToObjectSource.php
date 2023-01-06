<?php

namespace Tests\DataFixtures\Model\Relations;

class DtoToObjectSource
{
    /**
     * @var DtoToObjectSourceProp
     */
    public $optionA;

    /**
     * DtoToObjectSource constructor.
     */
    public function __construct()
    {
        $this->optionA = new DtoToObjectSourceProp();
    }
}