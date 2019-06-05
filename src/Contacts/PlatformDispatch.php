<?php

namespace Fx\Platform\Contacts;

interface PlatformDispatch
{
	public function register($abstract, $default);

	public function registerGroup($abstracts);
}