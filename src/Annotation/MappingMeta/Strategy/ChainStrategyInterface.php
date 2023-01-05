<?php

namespace DtoMapperBundle\Annotation\MappingMeta\Strategy;

interface ChainStrategyInterface
{
    public function getStrategyClassName(): string;
}