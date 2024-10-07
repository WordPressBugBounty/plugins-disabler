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
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\FrontMatter\Data;

use HBP_Disabler_Vendor\League\CommonMark\Exception\MissingDependencyException;
use HBP_Disabler_Vendor\League\CommonMark\Extension\FrontMatter\Exception\InvalidFrontMatterException;
use HBP_Disabler_Vendor\Symfony\Component\Yaml\Exception\ParseException;
use HBP_Disabler_Vendor\Symfony\Component\Yaml\Yaml;
final class SymfonyYamlFrontMatterParser implements FrontMatterDataParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse(string $frontMatter)
    {
        if (!\class_exists(Yaml::class)) {
            throw new MissingDependencyException('Failed to parse yaml: "symfony/yaml" library is missing');
        }
        try {
            /** @psalm-suppress ReservedWord */
            return Yaml::parse($frontMatter);
        } catch (ParseException $ex) {
            throw InvalidFrontMatterException::wrap($ex);
        }
    }
}
