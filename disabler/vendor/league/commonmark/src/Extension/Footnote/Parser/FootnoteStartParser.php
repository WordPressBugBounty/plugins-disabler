<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) Rezo Zero / Ambroise Maupate
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\Footnote\Parser;

use HBP_Disabler_Vendor\League\CommonMark\Parser\Block\BlockStart;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Block\BlockStartParserInterface;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Cursor;
use HBP_Disabler_Vendor\League\CommonMark\Parser\MarkdownParserStateInterface;
use HBP_Disabler_Vendor\League\CommonMark\Reference\Reference;
use HBP_Disabler_Vendor\League\CommonMark\Util\RegexHelper;
final class FootnoteStartParser implements BlockStartParserInterface
{
    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        if ($cursor->isIndented() || $parserState->getLastMatchedBlockParser()->canHaveLazyContinuationLines()) {
            return BlockStart::none();
        }
        $match = RegexHelper::matchFirst('/^\[\^([^\s^\]]+)\]\:(?:\s|$)/', $cursor->getLine(), $cursor->getNextNonSpacePosition());
        if (!$match) {
            return BlockStart::none();
        }
        $cursor->advanceToNextNonSpaceOrTab();
        $cursor->advanceBy(\strlen($match[0]));
        $str = $cursor->getRemainder();
        \preg_replace('/^\[\^([^\s^\]]+)\]\:(?:\s|$)/', '', $str);
        if (\preg_match('/^\[\^([^\s^\]]+)\]\:(?:\s|$)/', $match[0], $matches) !== 1) {
            return BlockStart::none();
        }
        $reference = new Reference($matches[1], $matches[1], $matches[1]);
        $footnoteParser = new FootnoteParser($reference);
        return BlockStart::of($footnoteParser)->at($cursor);
    }
}
