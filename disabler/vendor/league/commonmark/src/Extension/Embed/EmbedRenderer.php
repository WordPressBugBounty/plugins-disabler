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
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\Embed;

use HBP_Disabler_Vendor\League\CommonMark\Node\Node;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\ChildNodeRendererInterface;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\NodeRendererInterface;
class EmbedRenderer implements NodeRendererInterface
{
    /**
     * @param Embed $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Embed::assertInstanceOf($node);
        return $node->getEmbedCode() ?? '';
    }
}
