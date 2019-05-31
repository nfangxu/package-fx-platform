<?php

namespace Fx\Platform\Providers;

use Illuminate\Support\ServiceProvider;
use \Fx\Platform\Services\PlatformService;
use Illuminate\Support\Facades\Route;
use Fx\Platform\Console\RepositoryMakeCommand;

class PlatformServiceProvider extends ServiceProvider
{
	public function boot()
	{
		Route::pattern(config('platform.route.key'), config('platform.route.pattern'));

		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('platform.php'),
		]);

		if ($this->app->runningInConsole()) {
			$this->commands([
				RepositoryMakeCommand::class,
			]);
		}
	}

	public function register()
	{
		$this->app->singleton('platform', function () {
			return new PlatformService();
		});
	}
}
