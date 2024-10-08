<?php

namespace HBP_Disabler_Vendor\Hybrid\Tools;

/**
 * @mixin \Hybrid\Tools\Enumerable
 */
class HigherOrderCollectionProxy
{
    /**
     * The collection being operated on.
     *
     * @var \Hybrid\Tools\Enumerable
     */
    protected $collection;
    /**
     * The method being proxied.
     *
     * @var string
     */
    protected $method;
    /**
     * Create a new proxy instance.
     *
     * @param  string $method
     * @return void
     */
    public function __construct(Enumerable $collection, $method)
    {
        $this->method = $method;
        $this->collection = $collection;
    }
    /**
     * Proxy accessing an attribute onto the collection items.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->collection->{$this->method}(static fn($value) => is_array($value) ? $value[$key] : $value->{$key});
    }
    /**
     * Proxy a method call onto the collection items.
     *
     * @param  string $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->collection->{$this->method}(static fn($value) => $value->{$method}(...$parameters));
    }
}
