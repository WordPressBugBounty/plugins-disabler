<?php

/**
 * View service provider.
 */

namespace HBP\Disabler\View;

use HBP_Disabler_Vendor\Hybrid\Core\ServiceProvider;
use function HBP_Disabler_Vendor\Hybrid\public_path;
use function HBP_Disabler_Vendor\Hybrid\Tools\WordPress\get_child_theme_file_path;

/**
 * View service provider.
 */
class Provider extends ServiceProvider {
    /**
     * Boot.
     */
    public function boot() {
        $this->loadViewsFrom( [get_child_theme_file_path( 'views/hbp-disabler' ), get_parent_theme_file_path( 'views/hbp-disabler' ), public_path( 'views' )], 'HBP/Disabler' );
    }
}
