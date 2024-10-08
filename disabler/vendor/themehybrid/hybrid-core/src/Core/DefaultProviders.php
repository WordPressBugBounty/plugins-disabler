<?php

namespace HBP_Disabler_Vendor\Hybrid\Core;

use function HBP_Disabler_Vendor\Hybrid\Tools\collect;
class DefaultProviders
{
    /**
     * The current providers.
     *
     * @var array
     */
    protected $providers;
    /**
     * Create a new default provider collection.
     *
     * @return void
     */
    public function __construct(?array $providers = null)
    {
        $this->providers = $providers ?: [];
    }
    /**
     * Merge the given providers into the provider collection.
     *
     * @return static
     */
    public function merge(array $providers)
    {
        $this->providers = array_merge($this->providers, $providers);
        return new static($this->providers);
    }
    /**
     * Replace the given providers with other providers.
     *
     * @param  array $items
     * @return static
     */
    public function replace(array $replacements)
    {
        $current = collect($this->providers);
        foreach ($replacements as $from => $to) {
            $key = $current->search($from);
            $current = $key ? $current->replace([$key => $to]) : $current;
        }
        return new static($current->values()->toArray());
    }
    /**
     * Disable the given providers.
     *
     * @return static
     */
    public function except(array $providers)
    {
        return new static(collect($this->providers)->reject(static fn($p) => in_array($p, $providers))->values()->toArray());
    }
    /**
     * Convert the provider collection to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->providers;
    }
}
