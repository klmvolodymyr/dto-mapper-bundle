<?php

namespace Tests\DataFixtures\Model\Rename;

use DtoMapperBundle\Annotation\MappingMeta\DestinationClass;

/**
 * @DestinationClass
 */
class CustomerInfoDto
{
    public $fistName;
    public $lastName;
    public $department;
    public $birthday;
}