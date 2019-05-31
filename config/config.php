<?php

return [
	'route' => [
		'key' => 'platform',
		'pattern' => 'admin|guest'
	],

	'dispatch' => 'App\\Repositories\\Services\\{platform}\\{abstractClassName}',

	'namespace' => [
		'contact' => 'App\\Repositories\\Contacts\\{abstractClassName}',
		'service' => 'App\\Repositories\\Services\\{platform}\\{abstractClassName}',
	],
];
