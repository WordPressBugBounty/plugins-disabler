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
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Renderer\Inline;

use HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use HBP_Disabler_Vendor\League\CommonMark\Node\Node;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\ChildNodeRendererInterface;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\NodeRendererInterface;
use HBP_Disabler_Vendor\League\CommonMark\Util\HtmlElement;
use HBP_Disabler_Vendor\League\CommonMark\Xml\XmlNodeRendererInterface;
final class StrongRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param Strong $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Strong::assertInstanceOf($node);
        $attrs = $node->data->get('attributes');
        return new HtmlElement('strong', $attrs, $childRenderer->renderNodes($node->children()));
    }
    public function getXmlTagName(Node $node): string
    {
        return 'strong';
    }
    /**
     * {@inheritDoc}
     */
    public function getXmlAttributes(Node $node): array
    {
        return [];
    }
}
