<?php

namespace DtoMapperBundle\Annotation\MappingMeta;

interface EmbeddedInterface
{
    public function getTarget(): string;
    public function isMulti(): bool;
}