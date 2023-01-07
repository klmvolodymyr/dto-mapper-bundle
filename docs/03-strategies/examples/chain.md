
# Chain Strategy Annotation

Strategy extracts chain of strategies, passing each strategy execution result to the strategy.

## Note:

You don't have to mark source for each inner Strategy in chain list.
All ChainStrategy children should apply parent source.

```php
<?php

use DtoMapperBundle\Annotation\MappingMeta\Strategy;

/**
    @Strategy\ChainStrategy(
        source="SourceObject", 
        list={
             @Strategy\GetterStrategy(method="getSum")
             @Strategy\ServiceClosureStrategy(
                 provider="ClosureServiceProvider",
                 method="multiply"
             )
         }
     )
 */
```

Example:
```php

<?php

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\Strategy;
use DtoMapperBundle\Annotation\MappingMeta\SourceClass;

/**
 * Class ResultDto
 * @SourceClass
 */
class SourceObject
{
    /**
     * @Strategy\ChainStrategy(
     *     source="SourceObject",
     *     list={
     *          @Strategy\GetterStrategy(method="getSum"),
     *          @Strategy\ServiceClosureStrategy(
     *              provider="ClosureServiceProvider",
     *              method="multiply"
     *          ),
     *          @Strategy\ServiceClosureStrategy(
     *              provider="ClosureServiceProvider",
     *              method="divide"
     *          )
     *      }
     * )
     */
    public $result;
    private int $variableA = 10;
    private int $variableB = 10;

    public function getSum(): int
    {
        return $this->variableA + $this->variableB;
    }
}

class ClosureServiceProvider
{
    private int $multiplier = 10;
    private int $divider = 2;

    public function multiply(): \Closure
    {
        return function (int $value):int {
            return $value * $this->multiplier; 
        };
    }
    
    public function divide(): \Closure
    {
        return function (int $value):int {
            return $value / $this->divider; 
        };
    }
}

/**
 * Class ResultDto
 * @DestinationClass
 */
class ResultDto
{
    public $result;
}

use DataMapper\MapperInterface;

/** @var MapperInterface $mapper */
$dto = $mapper->convert(new SourceObject(), ResultDto::class);
echo $dto->result; // 100
```
[back](..)