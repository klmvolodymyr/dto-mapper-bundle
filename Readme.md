Dto mapper bundle. (* in development*)

Install
```bash
$ composer require volodymyr-klymniuk/dto-mapper
```

Just mark your destination class by meta annotations and push your array to MapperClass.

Example:

```php
<?php

use MapperBundle\Mapping\Annotation\Meta\PropertyClassRelation;
use MapperBundle\Mapping\Annotation\Meta\DestinationClass;

/**
 * Class RelationsRequestDto
 * @DestinationClass
 */
class RelationsRequestDto
{
    /**
     * @PropertyClassRelation(targetClass="Tests\DataFixtures\Dto\Destination\RegistrationRequestDto", multiply="true")
     *
     * @var RegistrationRequestDto[]
     */
    public $registrationsRequests = [];

    /**
     * @PropertyClassRelation(targetClass="Tests\DataFixtures\Dto\Destination\PersonalInfoDto")
     *
     * @var PersonalInfoDto
     */
    public $personalInfo;

    /**
     * @var array
     */
    public $extra = [];
}    
``` 

Mapping directions: 

    - Array to Object
    - Array to ClassName
    - Object to Array