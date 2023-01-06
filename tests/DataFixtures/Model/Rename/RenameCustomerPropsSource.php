<?php

namespace Tests\DataFixtures\Model\Rename;

use DtoMapperBundle\Annotation\MappingMeta\SourceClass;

/**
 * Class RenameCustomerPropsSource
 *
 * @SourceClass(namingStrategies={
 *     @MapNamingStrategy(
 *      convert={
 *          @Map(from="propAA", to="fistName"),
 *          @Map(from="propBB", to="lastName"),
 *          @Map(from="propCC", to="department"),
 *          @Map(from="propDD", to="birthday")
 *     })
 * })
 */
class RenameCustomerPropsSource
{
    public string $propAA = 'Ivan';
    public string $propBB = 'Ivanov';
    public string $propCC = 'Retail';

    /**
     * @Strategy\GetterStrategy(method="getBirthday")
     */
    public $propDD;

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return '2018-18-18';
    }
}