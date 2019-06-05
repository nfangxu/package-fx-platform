<?php

namespace Fx\Platform\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Fx\Platform\Console\RepositoryMakeCommand;
use Fx\Platform\Console\PlatformInitCommand;

class PlatformServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$pattern = implode("|", config('platform.route.platforms', []));

		Route::pattern(config('platform.route.key'), $pattern);

		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('platform.php'),
		]);

		if ($this->app->runningInConsole()) {
			$this->commands([
				RepositoryMakeCommand::class,
				PlatformInitCommand::class,
			]);
		}
	}

	public function register()
	{
		// 
	}
}
