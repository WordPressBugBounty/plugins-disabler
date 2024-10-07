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
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\HeadingPermalink;

use HBP_Disabler_Vendor\League\CommonMark\Environment\EnvironmentAwareInterface;
use HBP_Disabler_Vendor\League\CommonMark\Environment\EnvironmentInterface;
use HBP_Disabler_Vendor\League\CommonMark\Event\DocumentParsedEvent;
use HBP_Disabler_Vendor\League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use HBP_Disabler_Vendor\League\CommonMark\Node\NodeIterator;
use HBP_Disabler_Vendor\League\CommonMark\Node\RawMarkupContainerInterface;
use HBP_Disabler_Vendor\League\CommonMark\Node\StringContainerHelper;
use HBP_Disabler_Vendor\League\CommonMark\Normalizer\TextNormalizerInterface;
use HBP_Disabler_Vendor\League\Config\ConfigurationInterface;
use HBP_Disabler_Vendor\League\Config\Exception\InvalidConfigurationException;
/**
 * Searches the Document for Heading elements and adds HeadingPermalinks to each one
 */
final class HeadingPermalinkProcessor implements EnvironmentAwareInterface
{
    public const INSERT_BEFORE = 'before';
    public const INSERT_AFTER = 'after';
    public const INSERT_NONE = 'none';
    /** @psalm-readonly-allow-private-mutation */
    private TextNormalizerInterface $slugNormalizer;
    /** @psalm-readonly-allow-private-mutation */
    private ConfigurationInterface $config;
    public function setEnvironment(EnvironmentInterface $environment): void
    {
        $this->config = $environment->getConfiguration();
        $this->slugNormalizer = $environment->getSlugNormalizer();
    }
    public function __invoke(DocumentParsedEvent $e): void
    {
        $min = (int) $this->config->get('heading_permalink/min_heading_level');
        $max = (int) $this->config->get('heading_permalink/max_heading_level');
        $applyToHeading = (bool) $this->config->get('heading_permalink/apply_id_to_heading');
        $idPrefix = (string) $this->config->get('heading_permalink/id_prefix');
        $slugLength = (int) $this->config->get('slug_normalizer/max_length');
        $headingClass = (string) $this->config->get('heading_permalink/heading_class');
        if ($idPrefix !== '') {
            $idPrefix .= '-';
        }
        foreach ($e->getDocument()->iterator(NodeIterator::FLAG_BLOCKS_ONLY) as $node) {
            if ($node instanceof Heading && $node->getLevel() >= $min && $node->getLevel() <= $max) {
                $this->addHeadingLink($node, $slugLength, $idPrefix, $applyToHeading, $headingClass);
            }
        }
    }
    private function addHeadingLink(Heading $heading, int $slugLength, string $idPrefix, bool $applyToHeading, string $headingClass): void
    {
        $text = StringContainerHelper::getChildText($heading, [RawMarkupContainerInterface::class]);
        $slug = $this->slugNormalizer->normalize($text, ['node' => $heading, 'length' => $slugLength]);
        if ($applyToHeading) {
            $heading->data->set('attributes/id', $idPrefix . $slug);
        }
        if ($headingClass !== '') {
            $heading->data->append('attributes/class', $headingClass);
        }
        $headingLinkAnchor = new HeadingPermalink($slug);
        switch ($this->config->get('heading_permalink/insert')) {
            case self::INSERT_BEFORE:
                $heading->prependChild($headingLinkAnchor);
                return;
            case self::INSERT_AFTER:
                $heading->appendChild($headingLinkAnchor);
                return;
            case self::INSERT_NONE:
                return;
            default:
                throw new InvalidConfigurationException("Invalid configuration value for heading_permalink/insert; expected 'before', 'after', or 'none'");
        }
    }
}
