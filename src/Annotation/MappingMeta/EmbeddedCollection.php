<?php

namespace DtoMapperBundle\Annotation\MappingMeta;

use Doctrine\Common\Annotations\Annotation;
use DtoMapperBundle\Annotation\Exception\InvalidTargetClassException;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedInterface;

/**
 * @Annotation
 * @Annotation\Target("PROPERTY")
 */
class EmbeddedCollection  implements EmbeddedInterface
{
    /**
     * @Annotation\Required()
     */
    public $target;

    /**
     * @var bool
     */
    public $multi = true;

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     *
     * @return \VKMapperBundle\Annotation\MappingMeta\EmbeddedCollection
     */
    public function setTarget(string $target): self
    {
        if (\class_exists($target)) {
            throw new \VKMapperBundle\Annotation\Exception\InvalidTargetClassException("$target - class is not registered.");
        }

        $this->target = $target;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMulti(): bool
    {
        return $this->multi;
    }
}