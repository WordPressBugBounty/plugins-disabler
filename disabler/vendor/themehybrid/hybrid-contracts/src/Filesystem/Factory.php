<?php

namespace HBP_Disabler_Vendor\Hybrid\Contracts\Filesystem;

interface Factory
{
    /**
     * Get a filesystem implementation.
     *
     * @param  string|null $name
     * @return \Hybrid\Contracts\Filesystem\Filesystem
     */
    public function disk($name = null);
}
