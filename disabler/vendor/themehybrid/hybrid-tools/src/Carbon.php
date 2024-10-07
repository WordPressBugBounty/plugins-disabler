<?php

namespace HBP_Disabler_Vendor\Hybrid\Tools;

use HBP_Disabler_Vendor\Carbon\Carbon as BaseCarbon;
use HBP_Disabler_Vendor\Carbon\CarbonImmutable as BaseCarbonImmutable;
use HBP_Disabler_Vendor\Hybrid\Tools\Traits\Conditionable;
use HBP_Disabler_Vendor\Ramsey\Uuid\Uuid;
use HBP_Disabler_Vendor\Symfony\Component\Uid\Ulid;
class Carbon extends BaseCarbon
{
    use Conditionable;
    /**
     * {@inheritDoc}
     */
    public static function setTestNow($testNow = null)
    {
        BaseCarbon::setTestNow($testNow);
        BaseCarbonImmutable::setTestNow($testNow);
    }
    /**
     * Create a Carbon instance from a given ordered UUID or ULID.
     *
     * @param  \Ramsey\Uuid\Uuid|\Symfony\Component\Uid\Ulid|string $id
     * @return \Hybrid\Tools\Carbon
     */
    public static function createFromId($id)
    {
        return Ulid::isValid($id) ? static::createFromInterface(Ulid::fromString($id)->getDateTime()) : static::createFromInterface(Uuid::fromString($id)->getDateTime());
    }
    /**
     * Dump the instance and end the script.
     *
     * @param  mixed ...$args
     * @return never
     */
    public function dd(...$args)
    {
        dd($this, ...$args);
    }
    /**
     * Dump the instance.
     *
     * @return $this
     */
    public function dump()
    {
        dump($this);
        return $this;
    }
}
