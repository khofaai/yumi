<?php

namespace Chibi\Console\Commands;

use Chibi\Console\Commands\YumiCommand;

class YumiCreateModelCommand extends YumiCommand
{
	/**
	 * Hold command name
	 * @var string
	 */
	protected $name = "create:model";

	/**
	 * Hold command description
	 * @var string
	 */
	protected $description = "create new model";

	/**
	 * Hold command arguments
	 * @var array
	 */
	protected $arguments = [
		'name' => 'model name'
	];

	/**
	 * Hold command options
	 * @var array
	 */
	protected $options = [
		'@table' => 'table name for this model'
	];
	
	/**
	 * @inheritdoc
	 */
	public function fire() 
	{
		$params = explode('/', $this->getArgument('name'));
		$name = array_pop($params);
		$namespace = implode('\\', $params);

		$generated = $this->generateCommandClass([
			'template' => 'create/model',
			'toReplace' => [
				'ModelNamespace' => 'App'. ($namespace != '' ? '\\'.$namespace : ''),
				'ModelName' => ucfirst($name),
				'tableName' => $this->getOption('table') != '' ? $this->getOption('table') : strtolower($name)
			],
			'path' => base_path('app/'.($namespace != '' ? implode('/', $params) : '')),
			'name' => ucfirst($name).'.php'
		]);

		if ($generated) {
			$this->success(ucfirst($name).' Model created successfully !');
		} else {
			$this->error(ucfirst($name).' Model already exist !');
		}
	}
}