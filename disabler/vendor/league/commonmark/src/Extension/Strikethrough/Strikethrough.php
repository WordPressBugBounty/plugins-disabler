<?php

declare (strict_types=1);
/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com> and uAfrica.com (http://uafrica.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\Strikethrough;

use HBP_Disabler_Vendor\League\CommonMark\Node\Inline\AbstractInline;
use HBP_Disabler_Vendor\League\CommonMark\Node\Inline\DelimitedInterface;
final class Strikethrough extends AbstractInline implements DelimitedInterface
{
    private string $delimiter;
    public function __construct(string $delimiter = '~~')
    {
        parent::__construct();
        $this->delimiter = $delimiter;
    }
    public function getOpeningDelimiter(): string
    {
        return $this->delimiter;
    }
    public function getClosingDelimiter(): string
    {
        return $this->delimiter;
    }
}
