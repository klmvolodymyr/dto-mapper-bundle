# Declaration

Every mapped class should be marked by tag and mark by base annotation.

Annotations used by [`DtoMapperBundle\Annotation\MappingMetaReader`](https://github.com/volodymyr-klymniuk/dto-mapper-bundle/blob/master/src/Annotation/MappingMetaReader.php)

DtoMapperBundle has three base annotation types of class declaration. 
This annotations used to mark your class as convertible entity with mapped properties.
Only marked classes would be configure and stored to cache.

- DtoMapperBundle\Annotation\MappingMeta\SourceClass;
- DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
- DtoMapperBundle\Annotation\MappingMeta\MappedClass;

Use SourceClass and DestinationClass to customize properties naming strategy; [see details](https://github.com/volodymyr-klymniuk/dto-mapper-bundle/blob/master/docs/01-naming).
Use MappedClass to leave properties naming as is.

Example:

```php
<?php

namespace Tests\DataFixtures\Dto;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;
use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\MappedClass;

/**
 * @MappedClass
 */
class Any
{
    public $nodeA;
}

/**
 * @SourceClass
 */
class Source
{
    
}

/**
 * @DestinationClass 
 */
class Destination
{
    public $nodeA;
}
```

[back](..)