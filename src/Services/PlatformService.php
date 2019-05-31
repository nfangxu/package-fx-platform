<?php

namespace Fx\Platform\Services;

use Fx\Platform\Contacts\PlatformDispatch;
use Fx\Platform\Contacts\PlatformRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PlatformService implements PlatformDispatch, PlatformRoute
{
	public function dispatch($abstract, $default)
	{
		$service = self::getService($abstract);

		if (class_exists($service)) {
			return app()->make($service);
		} else {
			return app()->make($default);
		}
	}

	protected static function platform()
	{
		return Str::ucfirst(request()->route(config('platform.route.key')));
	}

	protected static function getClassName($fullpath)
	{
		$parse = explode("\\", $fullpath);
		return end($parse);
	}

	protected static function getService($abstract)
	{
		$service = config('platform.dispatch');

		$service = str_replace("{platform}", self::platform(), $service);
		$service = str_replace("{abstractClassName}", self::getClassName($abstract), $service);

		return $service;
	}

	public function route($group)
	{
		$prefix = config('platform.route.key');

		Route::prefix("{{$prefix}}")->group($group);
	}

	public function is($platform)
	{
		return Str::lower($platform) == Str::lower(self::platform());
	}
}
