<?php

namespace Tests\DataFixtures\Service;

class ClosureStrategyService
{
    /**
     * @return \Closure
     */
    public static function getStaticClosure(): \Closure
    {
        return function () {
            return[ 1, 2, 3, 4 ];
        };
    }
}