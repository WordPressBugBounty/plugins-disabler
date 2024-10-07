<?php

namespace HBP_Disabler_Vendor\Hybrid\Tools;

interface DeferringDisplayableValue
{
    /**
     * Resolve the displayable value that the class is deferring.
     *
     * @return \Hybrid\Contracts\Htmlable|string
     */
    public function resolveDisplayableValue();
}
