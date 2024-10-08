<?php

namespace HBP_Disabler_Vendor\Hybrid\Core;

use HBP_Disabler_Vendor\Hybrid\Tools\HtmlString;
use HBP_Disabler_Vendor\Hybrid\Tools\Str;
use function HBP_Disabler_Vendor\Hybrid\app;
use function HBP_Disabler_Vendor\Hybrid\public_path;
class Mix
{
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string $path
     * @param  string $manifestDirectory
     * @return \Hybrid\Tools\HtmlString|string
     * @throws \Exception
     */
    public function __invoke($path, $manifestDirectory = '')
    {
        static $manifests = [];
        if (!str_starts_with($path, '/')) {
            $path = "/{$path}";
        }
        if ($manifestDirectory && !str_starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }
        if (is_file(public_path($manifestDirectory . '/hot'))) {
            $url = rtrim(file_get_contents(public_path($manifestDirectory . '/hot')));
            $customUrl = app('config')->get('app.mix_hot_proxy_url');
            if (!empty($customUrl)) {
                return new HtmlString("{$customUrl}{$path}");
            }
            if (Str::startsWith($url, ['http://', 'https://'])) {
                return new HtmlString(Str::after($url, ':') . $path);
            }
            return new HtmlString("//localhost:8080{$path}");
        }
        $manifestPath = public_path($manifestDirectory . '/mix-manifest.json');
        if (!isset($manifests[$manifestPath])) {
            if (!is_file($manifestPath)) {
                throw new \Exception("Mix manifest not found at: {$manifestPath}");
            }
            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), \true);
        }
        $manifest = $manifests[$manifestPath];
        if (!isset($manifest[$path])) {
            $exception = new \Exception("Unable to locate Mix file: {$path}.");
            if (!app('config')->get('app.debug')) {
                report($exception);
                return $path;
            }
            throw $exception;
        }
        return new HtmlString(app('config')->get('app.mix_url') . $manifestDirectory . $manifest[$path]);
    }
}
