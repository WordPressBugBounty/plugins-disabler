<?php

namespace HBP_Disabler_Vendor\Hybrid\Log\Traits;

use HBP_Disabler_Vendor\Monolog\Level;
use HBP_Disabler_Vendor\Monolog\Logger;
if (Logger::API === 3) {
    trait Levels
    {
        /**
         * The Log levels.
         *
         * @var array
         */
        protected $levels = ['alert' => Level::Alert, 'critical' => Level::Critical, 'debug' => Level::Debug, 'emergency' => Level::Emergency, 'error' => Level::Error, 'info' => Level::Info, 'notice' => Level::Notice, 'warning' => Level::Warning];
    }
} else {
    trait Levels
    {
        /**
         * The Log levels.
         *
         * @var array
         */
        protected $levels = ['alert' => Logger::ALERT, 'critical' => Logger::CRITICAL, 'debug' => Logger::DEBUG, 'emergency' => Logger::EMERGENCY, 'error' => Logger::ERROR, 'info' => Logger::INFO, 'notice' => Logger::NOTICE, 'warning' => Logger::WARNING];
    }
}
