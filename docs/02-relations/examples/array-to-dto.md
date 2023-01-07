```php
<?php

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedClass;
use DtoMapperBundle\Annotation\MappingMeta\EmbeddedCollection;
use DataMapper\MapperInterface;

/**
 * Class MappedRelationsRootDto
 *
 * @DestinationClass()
 */
class MappedRelationsRootDto
{
    /**
     * @EmbeddedClass(target="Tests\DataFixtures\Dto\MappedRelationsNodeDto")
     */
    public $nodeA;

    /**
     * @EmbeddedClass(target="Tests\DataFixtures\Dto\MappedRelationsNodeDto")
     */
    public $nodeB;

    /**
     * @EmbeddedCollection(target="Tests\DataFixtures\Model\Relations\MappedRelationsNodeInfo")
     */
    public $event = [];
}

/** @var MapperInterface $mapper */
$mapper->convert($array, $mappedRelationsRootDto);

```

[back](..)