<?php

namespace HBP_Disabler_Vendor\Hybrid\Contracts;

interface Htmlable
{
    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml();
}
