<?php

return [
	'route' => [

		/**
		 * 路由中的参数, 用于分发各个平台
		 * 如路由中的参数与你的业务中参数冲突, 可修改此参数
		 */
		'key' => 'platform',

		/**
		 * 平台的列表
		 */
		'platforms' => [
			'admin',
			'guest'
		],
	],

	/**
	 * 请务必保证 dispatch 的值与 repository.service 的值相对应, 否则, 分发的时候无法找到对应的 Repository;
	 * repository.contact 的值可随意指定
	 * 
	 * For example :
	 *         'dispatch' => 'App\\Repositories\\Services\\{platform}\\{abstractClassName}',
	 * 
	 *         'repository' => [
	 *               'contact' => 'App\\Repositories\\Contacts',
	 *               'service' => 'App\\Repositories\\Services\\{platform}',
	 *          ],
	 */
	'dispatch' => 'App\\Repositories\\Services\\{platform}\\{abstractClassName}',

	/**
	 * Repository 路径
	 */
	'repository' => [
		'contact' => 'App\\Repositories\\Contacts',
		'service' => 'App\\Repositories\\Services\\{platform}',
	],
];
