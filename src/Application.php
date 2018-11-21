<?php

namespace Chibi\Console;

use Symfony\Component\Console\Application as SymfonyApplication; 

class Application extends SymfonyApplication 
{	
	/**
	 * [$app description]
	 * @var [type]
	 */
	protected static $app;

	/**
	 * [$app description]
	 * @var [type]
	 */
	protected static $commands = [];

	/**
	 * [$app description]
	 * @var [type]
	 */
	protected static $baseCommands = [
		\Chibi\Console\Commands\YumiCreateCommand::class,
		\Chibi\Console\Commands\YumiCreateControllerCommand::class,
		\Chibi\Console\Commands\YumiCreateModelCommand::class,
		\Chibi\Console\Commands\YumiCreateHurdleCommand::class,
		\Chibi\Console\Commands\YumiCreateEventCommand::class,
	];

	/**
	 * @param  array  $newCommands [description]
	 * @return void
	 */
	public static function console($newCommands = []) 
	{
		$app = new SymfonyApplication();
		self::mapCommands($app,$newCommands);
		return $app->run();
	}
	
	/**
	 * @param  SymfonyApplication $app
	 * @param  array $newCommands
	 * @return map all commands
	 */
	protected function mapCommands($app, $newCommands) 
	{
		$allCommands = array_merge(self::$baseCommands, $newCommands);
		foreach ($allCommands as $command) {
			$app->add(new $command());
		}
	}
}