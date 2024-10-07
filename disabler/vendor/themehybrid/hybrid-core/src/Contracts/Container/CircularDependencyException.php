<?php

/**
 * @license https://opensource.org/licenses/MIT
 */
namespace HBP_Disabler_Vendor\Hybrid\Contracts\Container;

use HBP_Disabler_Vendor\Psr\Container\ContainerExceptionInterface;
class CircularDependencyException extends \Exception implements ContainerExceptionInterface
{
}
