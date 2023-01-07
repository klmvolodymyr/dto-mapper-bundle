<?php

namespace Tests\TestCase\Mapper;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use DataMapper\MapperInterface;

abstract class AbstractMapperTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    protected function getMapper(): MapperInterface
    {
        return self::$container->get(MapperInterface::class);
    }
}