<?php

/**
 * This file is part of the ramsey/uuid library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
declare (strict_types=1);
namespace HBP_Disabler_Vendor\Ramsey\Uuid\Builder;

use HBP_Disabler_Vendor\Ramsey\Uuid\Codec\CodecInterface;
use HBP_Disabler_Vendor\Ramsey\Uuid\Converter\NumberConverterInterface;
use HBP_Disabler_Vendor\Ramsey\Uuid\Converter\Time\DegradedTimeConverter;
use HBP_Disabler_Vendor\Ramsey\Uuid\Converter\TimeConverterInterface;
use HBP_Disabler_Vendor\Ramsey\Uuid\DegradedUuid;
use HBP_Disabler_Vendor\Ramsey\Uuid\Rfc4122\Fields as Rfc4122Fields;
use HBP_Disabler_Vendor\Ramsey\Uuid\UuidInterface;
/**
 * @deprecated DegradedUuid instances are no longer necessary to support 32-bit
 *     systems. Transition to {@see DefaultUuidBuilder}.
 *
 * @psalm-immutable
 */
class DegradedUuidBuilder implements UuidBuilderInterface
{
    private TimeConverterInterface $timeConverter;
    /**
     * @param NumberConverterInterface $numberConverter The number converter to
     *     use when constructing the DegradedUuid
     * @param TimeConverterInterface|null $timeConverter The time converter to use
     *     for converting timestamps extracted from a UUID to Unix timestamps
     */
    public function __construct(private NumberConverterInterface $numberConverter, ?TimeConverterInterface $timeConverter = null)
    {
        $this->timeConverter = $timeConverter ?: new DegradedTimeConverter();
    }
    /**
     * Builds and returns a DegradedUuid
     *
     * @param CodecInterface $codec The codec to use for building this DegradedUuid instance
     * @param string $bytes The byte string from which to construct a UUID
     *
     * @return DegradedUuid The DegradedUuidBuild returns an instance of Ramsey\Uuid\DegradedUuid
     *
     * @psalm-pure
     */
    public function build(CodecInterface $codec, string $bytes): UuidInterface
    {
        return new DegradedUuid(new Rfc4122Fields($bytes), $this->numberConverter, $codec, $this->timeConverter);
    }
}
