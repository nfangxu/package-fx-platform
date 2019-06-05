<?php

namespace Fx\Platform\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class RepositoryMakeCommand extends GeneratorCommand
{
	protected $signature = 'platform:make {name}';

	protected $description = 'Create new repository classes';

	protected $type = 'Repository';

	public function handle()
	{
		$contact = $this->getQualifyClass($this->getNameInput(), $this->getContactNamespace());

		$this->make($contact, 'Respository', $this->builder($contact, $this->getContactStub()));

		$platforms = config('platform.route.platforms');

		foreach ($platforms as $platform) {
			$platform = Str::ucfirst(Str::camel($platform));
			$service = $this->getQualifyClass($this->getNameInput(), $this->getServiceNamespace($platform));
			$this->make(
				$service,
				$platform . " Respository",
				$this->builder($service, $this->getServiceStub(), $contact)
			);
		}
	}

	protected function exists($name)
	{
		return $this->files->exists($this->getPath($name));
	}

	protected function getQualifyClass($name, $rootNamespace)
	{
		$name = ltrim($name, '\\/');

		if (Str::startsWith($name, $rootNamespace)) {
			return $name;
		}

		$name = str_replace('/', '\\', $name);

		return $this->getQualifyClass(
			trim($rootNamespace, '\\') . '\\' . $name,
			$rootNamespace
		);
	}

	protected function make($name, $type, $build)
	{
		if ((!$this->hasOption('force') ||
				!$this->option('force')) &&
			$this->exists($name)
		) {

			$this->error($type . ' already exists!');
		} else {

			$path = $this->getPath($name);

			$this->makeDirectory($path);

			$this->files->put($path, $build);

			$this->info($type . ' created successfully.');
		}
	}

	protected function getContactStub()
	{
		return __DIR__ . '/stubs/repository.contact.stub';
	}

	protected function getServiceStub()
	{
		return __DIR__ . '/stubs/repository.service.stub';
	}

	protected function getContactNamespace()
	{
		return config('platform.repository.contact');
	}

	protected function getServiceNamespace($platform)
	{
		return str_replace(
			"{platform}",
			$platform,
			config('platform.repository.service')
		);
	}

	protected function builder($name, $stub, $contact = "")
	{
		$stub = $this->files->get($stub);

		$stub = str_replace(
			['DummyNamespace', 'DummyInterfaceClass'],
			[$this->getNamespace($name), $contact],
			$stub
		);

		return $this->replaceClass($stub, $name);
	}

	public function getStub()
	{
		//
	}
}
