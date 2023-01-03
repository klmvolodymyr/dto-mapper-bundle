<?php

namespace DtoMapperBundle\StrategyAdapter;

use DataMapper\Strategy\StrategyInterface;

class ServiceClosureStrategyAdapter implements StrategyInterface
{
    private $serviceProvider;
    private $getter;

    public function __construct($serviceProvider, string $getter)
    {
        $this->getter = $getter;
        $this->serviceProvider = $serviceProvider;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($value, $context)
    {
        /** @var \Closure $callback */
        $callback = $this->serviceProvider->{$this->getter}();
        $callback->bindTo($this->serviceProvider);
        [$originSource] = $context;

        // User experience improve, change default args order.
        // 1 source - origin data
        // 2 value - current value of source object mapped property
        return $callback($originSource, $value);
    }
}