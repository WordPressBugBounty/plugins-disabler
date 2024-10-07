<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) 2015 Martin Hasoň <martin.hason@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace HBP_Disabler_Vendor\League\CommonMark\Extension\Attributes;

use HBP_Disabler_Vendor\League\CommonMark\Environment\EnvironmentBuilderInterface;
use HBP_Disabler_Vendor\League\CommonMark\Event\DocumentParsedEvent;
use HBP_Disabler_Vendor\League\CommonMark\Extension\Attributes\Event\AttributesListener;
use HBP_Disabler_Vendor\League\CommonMark\Extension\Attributes\Parser\AttributesBlockStartParser;
use HBP_Disabler_Vendor\League\CommonMark\Extension\Attributes\Parser\AttributesInlineParser;
use HBP_Disabler_Vendor\League\CommonMark\Extension\ExtensionInterface;
final class AttributesExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addBlockStartParser(new AttributesBlockStartParser());
        $environment->addInlineParser(new AttributesInlineParser());
        $environment->addEventListener(DocumentParsedEvent::class, [new AttributesListener(), 'processDocument']);
    }
}
