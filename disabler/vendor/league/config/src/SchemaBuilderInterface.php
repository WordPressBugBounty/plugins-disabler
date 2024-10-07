<?php

declare (strict_types=1);
/*
 * This file is part of the league/config package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace HBP_Disabler_Vendor\League\Config;

use HBP_Disabler_Vendor\Nette\Schema\Schema;
/**
 * Interface that allows new schemas to be added to a configuration
 */
interface SchemaBuilderInterface
{
    /**
     * Registers a new configuration schema at the given top-level key
     */
    public function addSchema(string $key, Schema $schema): void;
}
