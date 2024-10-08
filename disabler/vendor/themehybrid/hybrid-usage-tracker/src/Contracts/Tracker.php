<?php

namespace HBP_Disabler_Vendor\Hybrid\Usage\Tracker\Contracts;

/**
 * Tracker interface.
 */
interface Tracker
{
    /**
     * Returns the tracker data.
     *
     * @return array
     */
    public function get();
}
