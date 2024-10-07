<?php

declare (strict_types=1);
/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Node\Block;

use HBP_Disabler_Vendor\League\CommonMark\Node\Block\AbstractBlock;
use HBP_Disabler_Vendor\League\CommonMark\Node\StringContainerInterface;
final class IndentedCode extends AbstractBlock implements StringContainerInterface
{
    private string $literal = '';
    public function getLiteral(): string
    {
        return $this->literal;
    }
    public function setLiteral(string $literal): void
    {
        $this->literal = $literal;
    }
}
