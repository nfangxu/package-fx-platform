<?php

namespace Fx\Platform\Facades;

use Illuminate\Support\Facades\Facade;
use Fx\Platform\Services\PlatformService;

/**
 * @method static \Fx\Platform\Contacts\PlatformDispatch registerGroup(array $abstracts)
 * @method static \Fx\Platform\Contacts\PlatformDispatch register(string $abstract, string $default)
 * @method static \Fx\Platform\Contacts\PlatformRoute route(\Closure $group)
 * @method static \Fx\Platform\Services\PlatformService is(string $platform)
 */
class Platform extends Facade
{
	protected static function getFacadeAccessor()
	{
		return PlatformService::class;
	}
}
