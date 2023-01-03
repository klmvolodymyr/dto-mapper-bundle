<?php

namespace DtoMapperBundle\Annotation\MappingMeta\NamingStrategy;

interface NamingStrategyInterface
{
    public function getSource(): ?string;
    public function getStrategyClassName(): string;
}