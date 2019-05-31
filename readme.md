# 多平台解决方案

## 安装说明

- Composer

```bash
composer require fx/platform
```

- 发布配置文件

```bash
php artisan vendor:publish --provider="Fx\\Platform\\Providers\\PlatformServiceProvider"
```

## 使用

- 路由

```php
// routes/web.php
use Fx\Platform\Facades\Platform;

// others ...

// 多平台路由组
Platform::route(function () {
	Route::get('test', 'HomeController@test');
});

```

- 绑定

```php
// App\Providers\AppServiceProvider

use Fx\Platform\Facades\Platform;
use App\Repositories\Contacts\UserRepository;
use App\Repositories\Admin\UserRepository as DefaultUserRepository;

public function register() 
{
	// others ...

	// UserRepository
	$this->app->bind(UserRepository::class, function () {
		return Platform::dispatch(UserRepository::class, DefaultUserRepository::class);
	});
}

```

- 使用

```php
// App\Http\Controllers\HomeController
use App\Repositories\Contacts\UserRepository;

public function test(UserRepository $user)
{
	// do somethings with $user
	// eg: $users = $user->get();
}
```