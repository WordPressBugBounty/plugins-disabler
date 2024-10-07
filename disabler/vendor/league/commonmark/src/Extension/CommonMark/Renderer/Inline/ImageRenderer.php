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

use HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use HBP_Disabler_Vendor\League\CommonMark\Node\Inline\Newline;
use HBP_Disabler_Vendor\League\CommonMark\Node\Node;
use HBP_Disabler_Vendor\League\CommonMark\Node\NodeIterator;
use HBP_Disabler_Vendor\League\CommonMark\Node\StringContainerInterface;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\ChildNodeRendererInterface;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\NodeRendererInterface;
use HBP_Disabler_Vendor\League\CommonMark\Util\HtmlElement;
use HBP_Disabler_Vendor\League\CommonMark\Util\RegexHelper;
use HBP_Disabler_Vendor\League\CommonMark\Xml\XmlNodeRendererInterface;
use HBP_Disabler_Vendor\League\Config\ConfigurationAwareInterface;
use HBP_Disabler_Vendor\League\Config\ConfigurationInterface;
final class ImageRenderer implements NodeRendererInterface, XmlNodeRendererInterface, ConfigurationAwareInterface
{
    /** @psalm-readonly-allow-private-mutation */
    private ConfigurationInterface $config;
    /**
     * @param Image $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Image::assertInstanceOf($node);
        $attrs = $node->data->get('attributes');
        $forbidUnsafeLinks = !$this->config->get('allow_unsafe_links');
        if ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($node->getUrl())) {
            $attrs['src'] = '';
        } else {
            $attrs['src'] = $node->getUrl();
        }
        $attrs['alt'] = $this->getAltText($node);
        if (($title = $node->getTitle()) !== null) {
            $attrs['title'] = $title;
        }
        return new HtmlElement('img', $attrs, '', \true);
    }
    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }
    public function getXmlTagName(Node $node): string
    {
        return 'image';
    }
    /**
     * @param Image $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        Image::assertInstanceOf($node);
        return ['destination' => $node->getUrl(), 'title' => $node->getTitle() ?? ''];
    }
    private function getAltText(Image $node): string
    {
        $altText = '';
        foreach (new NodeIterator($node) as $n) {
            if ($n instanceof StringContainerInterface) {
                $altText .= $n->getLiteral();
            } elseif ($n instanceof Newline) {
                $altText .= "\n";
            }
        }
        return $altText;
    }
}
