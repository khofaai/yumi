<?php

namespace Chibi\Console\Commands;

use Chibi\Console\Commands\YumiCommand;

class YumiCreateEventCommand extends YumiCommand
{
	/**
	 * Hold command name
	 * @var string
	 */
	protected $name = "create:event";

	/**
	 * Hold command description
	 * @var string
	 */
	protected $description = "create new event";

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