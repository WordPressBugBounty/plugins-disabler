<?php

namespace HBP\Disabler\Tools\UsageTracker\Trackers;

use HBP\Disabler\Admin\Options;
use HBP_Disabler_Vendor\Hybrid\Usage\Tracker\Contracts\CollectionInterface;
use HBP_Disabler_Vendor\Hybrid\Usage\Tracker\Contracts\Tracker;

/**
 * Settings tracker for usage tracking.
 */
class Settings implements CollectionInterface, Tracker {
    /**
     * Retrieve the settings tracker data.
     *
     * @return array The merged array of options and defaults.
     */
    public function get() {
        return ['disabler' => Options::all()];
    }
}
