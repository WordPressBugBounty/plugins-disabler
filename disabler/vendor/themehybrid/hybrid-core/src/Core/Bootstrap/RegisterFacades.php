<?php

namespace HBP_Disabler_Vendor\Hybrid\Core\Bootstrap;

use HBP_Disabler_Vendor\Hybrid\Contracts\Core\Application;
use HBP_Disabler_Vendor\Hybrid\Core\AliasLoader;
use HBP_Disabler_Vendor\Hybrid\Core\Facades\Facade;
use HBP_Disabler_Vendor\Hybrid\Core\PackageManifest;
class RegisterFacades
{
    /**
     * Bootstrap the given application.
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($app);
        $aliases = $app->make('config')->get('app.aliases', []);
        // If app doesn't define 'aliases' in `app.php`,
        // Hybrid Core wouldn't be able to use its default aliases.
        // so will have to initiate it here.
        if (count($aliases) === 0) {
            $aliases = Facade::defaultAliases()->merge([])->toArray();
        }
        $aliases = array_merge($aliases, $app->make(PackageManifest::class)->aliases());
        $prefixed_aliases=[];
					foreach( $aliases as $alias=>$class){
						$prefixed_aliases["HBP_Disabler_Vendor\\".$alias]=$class;
					}
					$aliases=$prefixed_aliases;
					AliasLoader::getInstance( $aliases )->register();
    }
}
