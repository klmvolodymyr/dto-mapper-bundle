<?php

namespace Tests\TestCase\Mapper;

use Tests\DataFixtures\Dto\ObjectToSnakeCaseArrayDto;
use Tests\DataFixtures\Dto\ObjectToUnderscoreArrayDto;

class ObjectExtractionTest extends AbstractMapperTest
{
    public function testUnderscoreNamingExtraction(): void
    {
        $obj = new ObjectToUnderscoreArrayDto();
        $mapper = $this->getMapper();
        $extracted = $mapper->extract($obj);
        $this->assertEquals($extracted['a_option'], $obj->aOption);
        $this->assertEquals($extracted['c_option']['a_option'], $obj->cOption->aOption);
        $this->assertEquals($extracted['b_option'], $obj->bOption);
        $this->assertEquals($extracted['c_option']['b_option'], $obj->cOption->bOption);
    }

    public function testSnakeCaseNamingExtraction(): void
    {
        $obj = new ObjectToSnakeCaseArrayDto();
        $mapper = $this->getMapper();
        $extracted = $mapper->extract($obj);
        $this->assertEquals($extracted['aOption'], $obj->a_option);
        $this->assertEquals($extracted['cOption']['aOption'], $obj->c_option->a_option);
        $this->assertEquals($extracted['bOption'], $obj->b_option);
        $this->assertEquals($extracted['cOption']['bOption'], $obj->c_option->b_option);
    }
}