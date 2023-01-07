# @Annotation - Getter Strategy
Strategy calls the "getter|formatter" method from source object for extraction property value.

Example:
```php
<?php 

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\Strategy;
use DtoMapperBundle\Annotation\MappingMeta\SourceClass;

/**
 * Class DestinationDto
 * @SourceClass
 */
class SourceObject
{
    /**
     * @Strategy\GetterStrategy(method="getSum")
     */
    public $sum;
    private int $variableA = 10;
    private int $variableB = 10;

    public function getSum(): int
    {
        return $this->variableA + $this->variableB;
    }
}

/**
 * Class DestinationDto
 * @DestinationClass
 */
class GetterDestinationDto
{
    public $sum;
}

use DataMapper\MapperInterface;

/** @var MapperInterface $mapper */
$dto = $mapper->convert(new SourceObject(), GetterDestinationDto::class);
echo $dto->sum; // 20
```

[back](..)