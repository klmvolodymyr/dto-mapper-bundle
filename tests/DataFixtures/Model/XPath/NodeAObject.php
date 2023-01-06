<?php

namespace Tests\DataFixtures\Model\XPath;

class NodeAObject
{
    /**
     * @var NodeAInnerObject
     */
    public $inner;

    /**
     * NodeAObject constructor.
     */
    public function __construct()
    {
        $this->inner = new NodeAInnerObject();
    }
}