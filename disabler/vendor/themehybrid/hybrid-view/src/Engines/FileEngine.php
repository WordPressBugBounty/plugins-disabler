<?php

namespace HBP_Disabler_Vendor\Hybrid\View\Engines;

use HBP_Disabler_Vendor\Hybrid\Contracts\View\Engine;
use HBP_Disabler_Vendor\Hybrid\Filesystem\Filesystem;
class FileEngine implements Engine
{
    /**
     * The filesystem instance.
     *
     * @var \Hybrid\Filesystem\Filesystem
     */
    protected $files;
    /**
     * Create a new file engine instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }
    /**
     * Get the evaluated contents of the view.
     *
     * @param  string $path
     * @param  array  $data
     * @return string
     */
    public function get($path, array $data = [])
    {
        return $this->files->get($path);
    }
}
