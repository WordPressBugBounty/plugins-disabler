<?php

namespace HBP_Disabler_Vendor\Carbon\Doctrine;

use HBP_Disabler_Vendor\Carbon\CarbonImmutable;
use HBP_Disabler_Vendor\Doctrine\DBAL\Types\VarDateTimeImmutableType;
class DateTimeImmutableType extends VarDateTimeImmutableType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<CarbonImmutable> */
    use CarbonTypeConverter;
    /**
     * @return class-string<CarbonImmutable>
     */
    protected function getCarbonClassName(): string
    {
        return CarbonImmutable::class;
    }
}
