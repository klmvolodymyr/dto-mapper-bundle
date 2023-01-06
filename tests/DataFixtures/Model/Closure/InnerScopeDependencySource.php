<?php

namespace Tests\DataFixtures\Model\Closure;

class InnerScopeDependencySource
{
    /**
     * @return int
     */
    public function getValue(): int
    {
        return 100;
    }
}