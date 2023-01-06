<?php

namespace Tests\DataFixtures\Model\Closure;

class ClosureProvider
{
    private const TEXT = '- mapped by ClosureProvider';

    /**
     * @var InnerScopeDependencySource
     */
    private $innerScopeObject;

    /**
     * ClosureProvider constructor.
     */
    public function __construct()
    {
        $this->innerScopeObject = new InnerScopeDependencySource();
    }

    /**
     * @return \Closure
     */
    public static function getStaticClosure(): \Closure
    {
        return function (ClosureSource $source): string {
            return sprintf(
                "%d%s",
                $source->getSum(),
                static::getText()
            );
        };
    }

    /**
     * @return \Closure
     */
    public function getClosure(): \Closure
    {
        return function (ClosureSource $source): string {
            return sprintf("%d%s",
                ($source->getSum() + $this->innerScopeObject->getValue()),
                static::getText()
            );
        };
    }

    /**
     * @return string
     */
    public static function getText(): string
    {
        return self::TEXT;
    }
}