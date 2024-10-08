<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace HBP_Disabler_Vendor\Symfony\Component\Uid\Factory;

use HBP_Disabler_Vendor\Symfony\Component\Uid\UuidV4;
class RandomBasedUuidFactory
{
    private $class;
    public function __construct(string $class)
    {
        $this->class = $class;
    }
    public function create(): UuidV4
    {
        $class = $this->class;
        return new $class();
    }
}
