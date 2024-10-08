<?php

/**
 * @license https://opensource.org/licenses/MIT
 */
namespace HBP_Disabler_Vendor\Hybrid\Container;

use Countable;
use IteratorAggregate;
use Traversable;
class RewindableGenerator implements Countable, IteratorAggregate
{
    /**
     * The generator callback.
     *
     * @var callable
     */
    protected $generator;
    /**
     * The number of tagged services.
     *
     * @var callable|int
     */
    protected $count;
    /**
     * Create a new generator instance.
     *
     * @param  callable|int $count
     * @return void
     */
    public function __construct(callable $generator, $count)
    {
        $this->count = $count;
        $this->generator = $generator;
    }
    /**
     * Get an iterator from the generator.
     */
    public function getIterator(): Traversable
    {
        return ($this->generator)();
    }
    /**
     * Get the total number of tagged services.
     */
    public function count(): int
    {
        if (is_callable($count = $this->count)) {
            $this->count = $count();
        }
        return $this->count;
    }
}
