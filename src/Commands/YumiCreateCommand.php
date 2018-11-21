<?php

namespace Chibi\Console\Commands;

use Chibi\Console\Commands\YumiCommand;

class YumiCreateCommand extends YumiCommand
{
	/**
	 * Hold command name
	 * @var string
	 */
	protected $name = "create:command";

	/**
	 * Hold command description
	 * @var string
	 */
	protected $description = "create new command";

	/**
	 * Hold command arguments
	 * @var array
	 */
	protected $arguments = [
		'name' => 'this name argument'
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
		if(!$this->checkIfExist()) 
		{
			$params = explode('/', $this->getArgument('name'));
			$name = array_pop($params);
			$this->generateCommandClass('create/command',[
				'CommandNamespace' => implode('\\',$params),
				'CommandName' => $name
			]);
			$this->success($this->getArgument('name').' created successfully');
		} else {
			$this->error($this->getArgument('name').' already exist');
		}
	}

	private function checkIfExist()
	{
		$pathExist = dirname(__DIR__).'/Commands/'.$this->getArgument('name').'Command.php';
		return file_exists($pathExist);
	}
}