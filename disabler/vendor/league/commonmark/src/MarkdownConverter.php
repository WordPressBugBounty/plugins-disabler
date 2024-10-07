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
namespace HBP_Disabler_Vendor\League\CommonMark;

use HBP_Disabler_Vendor\League\CommonMark\Environment\EnvironmentInterface;
use HBP_Disabler_Vendor\League\CommonMark\Exception\CommonMarkException;
use HBP_Disabler_Vendor\League\CommonMark\Output\RenderedContentInterface;
use HBP_Disabler_Vendor\League\CommonMark\Parser\MarkdownParser;
use HBP_Disabler_Vendor\League\CommonMark\Parser\MarkdownParserInterface;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\HtmlRenderer;
use HBP_Disabler_Vendor\League\CommonMark\Renderer\MarkdownRendererInterface;
class MarkdownConverter implements ConverterInterface, MarkdownConverterInterface
{
    /** @psalm-readonly */
    protected EnvironmentInterface $environment;
    /** @psalm-readonly */
    protected MarkdownParserInterface $markdownParser;
    /** @psalm-readonly */
    protected MarkdownRendererInterface $htmlRenderer;
    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment = $environment;
        $this->markdownParser = new MarkdownParser($environment);
        $this->htmlRenderer = new HtmlRenderer($environment);
    }
    public function getEnvironment(): EnvironmentInterface
    {
        return $this->environment;
    }
    /**
     * Converts Markdown to HTML.
     *
     * @param string $input The Markdown to convert
     *
     * @return RenderedContentInterface Rendered HTML
     *
     * @throws CommonMarkException
     */
    public function convert(string $input): RenderedContentInterface
    {
        $documentAST = $this->markdownParser->parse($input);
        return $this->htmlRenderer->renderDocument($documentAST);
    }
    /**
     * Converts Markdown to HTML.
     *
     * @deprecated since 2.2; use {@link convert()} instead
     *
     * @param string $markdown The Markdown to convert
     *
     * @return RenderedContentInterface Rendered HTML
     *
     * @throws CommonMarkException
     */
    public function convertToHtml(string $markdown): RenderedContentInterface
    {
        \HBP_Disabler_Vendor\trigger_deprecation('league/commonmark', '2.2.0', 'Calling "convertToHtml()" on a %s class is deprecated, use "convert()" instead.', self::class);
        return $this->convert($markdown);
    }
    /**
     * Converts CommonMark to HTML.
     *
     * @see MarkdownConverter::convert()
     *
     * @throws CommonMarkException
     */
    public function __invoke(string $markdown): RenderedContentInterface
    {
        return $this->convert($markdown);
    }
}
