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
namespace HBP_Disabler_Vendor\League\CommonMark\Renderer;

use HBP_Disabler_Vendor\League\CommonMark\Environment\EnvironmentInterface;
use HBP_Disabler_Vendor\League\CommonMark\Event\DocumentPreRenderEvent;
use HBP_Disabler_Vendor\League\CommonMark\Event\DocumentRenderedEvent;
use HBP_Disabler_Vendor\League\CommonMark\Node\Block\AbstractBlock;
use HBP_Disabler_Vendor\League\CommonMark\Node\Block\Document;
use HBP_Disabler_Vendor\League\CommonMark\Node\Node;
use HBP_Disabler_Vendor\League\CommonMark\Output\RenderedContent;
use HBP_Disabler_Vendor\League\CommonMark\Output\RenderedContentInterface;
final class HtmlRenderer implements DocumentRendererInterface, ChildNodeRendererInterface
{
    /** @psalm-readonly */
    private EnvironmentInterface $environment;
    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment = $environment;
    }
    public function renderDocument(Document $document): RenderedContentInterface
    {
        $this->environment->dispatch(new DocumentPreRenderEvent($document, 'html'));
        $output = new RenderedContent($document, (string) $this->renderNode($document));
        $event = new DocumentRenderedEvent($output);
        $this->environment->dispatch($event);
        return $event->getOutput();
    }
    /**
     * {@inheritDoc}
     */
    public function renderNodes(iterable $nodes): string
    {
        $output = '';
        $isFirstItem = \true;
        foreach ($nodes as $node) {
            if (!$isFirstItem && $node instanceof AbstractBlock) {
                $output .= $this->getBlockSeparator();
            }
            $output .= $this->renderNode($node);
            $isFirstItem = \false;
        }
        return $output;
    }
    /**
     * @return \Stringable|string
     *
     * @throws NoMatchingRendererException
     */
    private function renderNode(Node $node)
    {
        $renderers = $this->environment->getRenderersForClass(\get_class($node));
        foreach ($renderers as $renderer) {
            \assert($renderer instanceof NodeRendererInterface);
            if (($result = $renderer->render($node, $this)) !== null) {
                return $result;
            }
        }
        throw new NoMatchingRendererException('Unable to find corresponding renderer for node type ' . \get_class($node));
    }
    public function getBlockSeparator(): string
    {
        return $this->environment->getConfiguration()->get('renderer/block_separator');
    }
    public function getInnerSeparator(): string
    {
        return $this->environment->getConfiguration()->get('renderer/inner_separator');
    }
}
