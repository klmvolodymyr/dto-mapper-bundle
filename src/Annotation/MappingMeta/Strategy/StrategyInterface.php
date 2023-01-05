<?php

namespace DtoMapperBundle\Annotation\MappingMeta\Strategy;

interface StrategyInterface
{
    public function getSource(): ?string;
    public function getStrategyClassName(): string;
}