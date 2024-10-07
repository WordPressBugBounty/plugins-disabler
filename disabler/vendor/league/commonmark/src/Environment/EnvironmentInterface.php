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
namespace HBP_Disabler_Vendor\League\CommonMark\Environment;

use HBP_Disabler_Vendor\League\CommonMark\Delimiter\Processor\DelimiterProcessorCollection;
use HBP_Disabler_Vendor\League\CommonMark\Extension\ExtensionInterface;
use HBP_Disabler_Vendor\League\CommonMark\Node\Node;
use HBP_Disabler_Vendor\League\CommonMark\Normalizer\TextNormalizerInterface;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Block\BlockStartParserInterface;
use HBP_Disabler_Vendor\League\CommonMark\Parser\Inline\InlineParserInterface;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\NodeRendererInterface;
use HBP_Disabler_Vendor\League\Config\ConfigurationProviderInterface;
use HBP_Disabler_Vendor\Psr\EventDispatcher\EventDispatcherInterface;
interface EnvironmentInterface extends ConfigurationProviderInterface, EventDispatcherInterface
{
    /**
     * Get all registered extensions
     *
     * @return ExtensionInterface[]
     */
    public function getExtensions(): iterable;
    /**
     * @return iterable<BlockStartParserInterface>
     */
    public function getBlockStartParsers(): iterable;
    /**
     * @return iterable<InlineParserInterface>
     */
    public function getInlineParsers(): iterable;
    public function getDelimiterProcessors(): DelimiterProcessorCollection;
    /**
     * @psalm-param class-string<Node> $nodeClass
     *
     * @return iterable<NodeRendererInterface>
     */
    public function getRenderersForClass(string $nodeClass): iterable;
    public function getSlugNormalizer(): TextNormalizerInterface;
}
