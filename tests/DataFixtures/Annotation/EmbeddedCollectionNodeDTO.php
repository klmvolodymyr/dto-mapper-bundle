<?php

namespace Tests\DataFixtures\Annotation;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;

/**
 * Class EmbeddedCollectionNodeDTO
 *
 * @DestinationClass
 */
class EmbeddedCollectionNodeDTO
{
    public $nodePropA;
    public $nodePropB;
    public $nodePropC;

    public function getNodePropA()
    {
        return $this->nodePropA;
    }

    public function getNodePropB()
    {
        return $this->nodePropB;
    }

    public function getNodePropC()
    {
        return $this->nodePropC;
    }
}