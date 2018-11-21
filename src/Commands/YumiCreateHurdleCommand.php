<?php

namespace Chibi\Console\Commands;

use Chibi\Console\Commands\YumiCommand;

class YumiCreateHurdleCommand extends YumiCommand
{
	/**
	 * Hold command name
	 * @var string
	 */
	protected $name = "create:hurdle";

	/**
	 * Hold command description
	 * @var string
	 */
	protected $description = "create new hurdle";

	/**
	 * Hold command arguments
	 * @var array
	 */
	protected $arguments = [
		// arguments goes here
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
		$this->comment($this->name.'::command is fired');
	}
}