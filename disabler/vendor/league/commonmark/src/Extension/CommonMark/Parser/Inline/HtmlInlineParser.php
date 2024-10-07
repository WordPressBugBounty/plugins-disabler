<?php

declare (strict_types=1);
/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Parser\Inline;

use HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Node\Inline\HtmlInline;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Inline\InlineParserInterface;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Inline\InlineParserMatch;
use HBP_Disabler_Vendor\League\CommonMark\Parser\InlineParserContext;
use HBP_Disabler_Vendor\League\CommonMark\Util\RegexHelper;
final class HtmlInlineParser implements InlineParserInterface
{
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex(RegexHelper::PARTIAL_HTMLTAG)->caseSensitive();
    }
    public function parse(InlineParserContext $inlineContext): bool
    {
        $inline = $inlineContext->getFullMatch();
        $inlineContext->getCursor()->advanceBy($inlineContext->getFullMatchLength());
        $inlineContext->getContainer()->appendChild(new HtmlInline($inline));
        return \true;
    }
}
