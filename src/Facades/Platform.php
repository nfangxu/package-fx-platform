<?php

namespace Fx\Platform\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Fx\Platform\Contacts\PlatformDispatch dispatch($abstract, $default)
 * @method static \Fx\Platform\Contacts\PlatformRoute route($group)
 * @method static \Fx\Platform\Services\PlatformService is($platform)
 */
class Platform extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'platform';
	}
}
