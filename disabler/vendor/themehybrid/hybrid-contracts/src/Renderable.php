<?php

namespace HBP_Disabler_Vendor\Hybrid\Contracts;

/**
 * Renderable interface.
 */
interface Renderable
{
    /**
     * Returns an HTML string for output.
     *
     * @return string
     */
    public function render();
}
