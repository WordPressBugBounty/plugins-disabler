<?php

declare (strict_types=1);
/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\SmartPunct;

use HBP_Disabler_Vendor\League\CommonMark\Node\Inline\Text;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Inline\InlineParserInterface;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Inline\InlineParserMatch;
use HBP_Disabler_Vendor\League\CommonMark\Parser\InlineParserContext;
final class EllipsesParser implements InlineParserInterface
{
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::oneOf('...', '. . .');
    }
    public function parse(InlineParserContext $inlineContext): bool
    {
        $inlineContext->getCursor()->advanceBy($inlineContext->getFullMatchLength());
        $inlineContext->getContainer()->appendChild(new Text('…'));
        return \true;
    }
}
