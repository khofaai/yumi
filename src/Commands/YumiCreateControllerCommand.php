<?php

namespace Chibi\Console\Commands;

use Chibi\Console\Commands\YumiCommand;
use Chibi\Console\Core\TemplateGenerator;

class YumiCreateControllerCommand extends YumiCommand
{
	/**
	 * Hold command name
	 * @var string
	 */
	protected $name = "create:controller";

	/**
	 * Hold command description
	 * @var string
	 */
	protected $description = "create new controller";

	/**
	 * Hold command arguments
	 * @var array
	 */
	protected $arguments = [
		'name' => 'controller name'
	];

	/**
	 * Hold command options
	 * @var array
	 */
	protected $options = [
		// options goes here
	];
	
	/**
	 * @inheritdoc
	 */
	public function fire() 
	{
		// bdump(base_path('app/Controllers/'.ucfirst($this->getArgument('name')).'Controller.php'));

		$params = explode('/', $this->getArgument('name'));
		$name = array_pop($params);
		$namespace = implode('\\', $params);

		$generated = $this->generateCommandClass([
			'template' => 'create/controller',
			'toReplace' => [
				'ControllerNamespace' => 'App\Controllers'. ($namespace != '' ? '\\'.$namespace : ''),
				'ControllerName' => ucfirst($name)
			],
			'path' => base_path('app/Controllers/'.($namespace != '' ? implode('/', $params) : '')),
			'name' => ucfirst($name).'Controller.php'
		]);
		if ($generated) {

			$this->success(ucfirst($name).'Controller created successfully !');
		} else {
			
			$this->error(ucfirst($name).'Controller already exist !');
		}
	}
}