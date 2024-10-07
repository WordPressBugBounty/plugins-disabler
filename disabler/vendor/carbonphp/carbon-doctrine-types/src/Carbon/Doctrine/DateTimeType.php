<?php

namespace HBP_Disabler_Vendor\Carbon\Doctrine;

use HBP_Disabler_Vendor\Carbon\Carbon;
use HBP_Disabler_Vendor\Doctrine\DBAL\Types\VarDateTimeType;
class DateTimeType extends VarDateTimeType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<Carbon> */
    use CarbonTypeConverter;
}
