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
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\TaskList;

use HBP_Disabler_Vendor\League\CommonMark\Node\Node;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\ChildNodeRendererInterface;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\NodeRendererInterface;
use HBP_Disabler_Vendor\League\CommonMark\Util\HtmlElement;
use HBP_Disabler_Vendor\League\CommonMark\Xml\XmlNodeRendererInterface;
final class TaskListItemMarkerRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param TaskListItemMarker $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        TaskListItemMarker::assertInstanceOf($node);
        $attrs = $node->data->get('attributes');
        $checkbox = new HtmlElement('input', $attrs, '', \true);
        if ($node->isChecked()) {
            $checkbox->setAttribute('checked', '');
        }
        $checkbox->setAttribute('disabled', '');
        $checkbox->setAttribute('type', 'checkbox');
        return $checkbox;
    }
    public function getXmlTagName(Node $node): string
    {
        return 'task_list_item_marker';
    }
    /**
     * @param TaskListItemMarker $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        TaskListItemMarker::assertInstanceOf($node);
        if ($node->isChecked()) {
            return ['checked' => 'checked'];
        }
        return [];
    }
}
