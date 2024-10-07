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
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Parser\Block;

use HBP_Disabler_Vendor\League\CommonMark\Node\Block\Paragraph;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Block\BlockStart;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Block\BlockStartParserInterface;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Cursor;
use HBP_Disabler_Vendor\League\CommonMark\Parser\MarkdownParserStateInterface;
final class IndentedCodeStartParser implements BlockStartParserInterface
{
    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        if (!$cursor->isIndented()) {
            return BlockStart::none();
        }
        if ($parserState->getActiveBlockParser()->getBlock() instanceof Paragraph) {
            return BlockStart::none();
        }
        if ($cursor->isBlank()) {
            return BlockStart::none();
        }
        $cursor->advanceBy(Cursor::INDENT_LEVEL, \true);
        return BlockStart::of(new IndentedCodeParser())->at($cursor);
    }
}
