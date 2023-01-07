# @Annotation - XPath Strategy

Recursive value search in inner object properties.

Example:
```php
<?php

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\Strategy;
use DtoMapperBundle\Annotation\MappingMeta\SourceClass;

class InnerObject
{
    private $innerProp = 10;
}

/**
 * Class XPathDestinationDto
 * @SourceClass
 */
class SourceObject
{
    /**
     * @Strategy\XPathStrategy(
     *     source="SourceObject",
     *     xPath="inner.innerProp"
     * )
     */
     private $inner;

     public function __construct()
     {
        $this->inner = new InnerObject();
     }
}

/**
 * Class XPathDestinationDto
 * @DestinationClass
 */
class XPathDestinationDto
{
    public $destinationProperty;
}

use DataMapper\MapperInterface;

/** @var MapperInterface $mapper */
$dto = $mapper->convert(new SourceObject(), XPathDestinationDto::class);

echo $dto->destinationProperty; // 10
```
[back](..)