<?php
namespace Chibi\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputArgument, InputInterface, InputOption };
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use Chibi\Console\{ Interfaces\CommandInterface, Core\TemplateGenerator };

abstract class YumiCommand extends Command implements CommandInterface {

	protected $input;
	protected $output;
	
	const SHORTCUT = null;
	const DEFAULT = 1;

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function configure()
	{
		$this->setName($this->name)
			 ->setDescription($this->description);
		$this->mapArguments();
		$this->mapOptions();
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function execute(InputInterface $input, OutputInterface $output)
	{
		$this->input = $input;
		$this->output = $output;
		$this->fire();
	}

	/**
	 * [generateCommandClass description]
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	protected function generateCommandClass($data)
	{
		$generator = new TemplateGenerator($data['template']);
		foreach ($data['toReplace'] as $key => $value) {
			$generator->replaceWith($key, $value);
		}
		return $generator->generate($data['name'], $data['path']);
	}

	/**
	 * [mapArguments description]
	 * @return [type] [description]
	 */
	protected function mapArguments () 
	{
		if (!empty($this->arguments)) {
			foreach ($this->arguments as $key => $description) {
				$required = $this->isRequire($key);
				$name = str_replace('@', '', $key);
				$this->addArgument(
					$name,
					$required ? InputArgument::OPTIONAL : InputArgument::REQUIRED,
					$description
				);
			}
		}
	}

	/**
	 * [mapOptions description]
	 * @return [type] [description]
	 */
	protected function mapOptions () 
	{
		if (!empty($this->options)) {
			foreach ($this->options as $key => $description) {
				$required = $this->isRequire($key);
				$name = str_replace('@', '', $key);
				$default = $this->hasDefault($name);
				$this->addOption(
			        $name,
			        self::SHORTCUT,
			        $required ? InputOption::VALUE_OPTIONAL : InputOption::VALUE_REQUIRED,
			        $description,
			        $default
			    );
			}
		}
	}

	/**
	 * [hasDefault description]
	 * @param  [type]  $name [description]
	 * @return boolean       [description]
	 */
	private function hasDefault(&$name)
	{
		$exp = explode('=',$name);
		$name = $exp[0];
		if (count($exp) > 1) {
			return $exp[1];
		}
		return '';
	}

	/**
	 * [isNotRequire description]
	 * @param  [type]  $arr [description]
	 * @return boolean      [description]
	 */
	private function isRequire($value) 
	{
		return strpos($value, '@') !== false;
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function hasArgument($argumentName)
	{
		return $this->input()
					->hasArgument($argumentName);
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function getArgument($argumentName)
	{
		return $this->input()
					->getArgument($argumentName);
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function getArguments()
	{
		return $this->input()
					->getArguments();
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function getOption($optionName)
	{
		return $this->input()
					->getOption($optionName);
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function getOptions()
	{
		return $this->input()
					->getOptions();
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function setOption($optionName,$value)
	{
		return $this->input()
					->setOption($optionName, $value);
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function hasOption()
	{
		return $this->input()
					->hasOption($optionName);
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function input()
	{
		return $this->input;
	}

	/**
	 * [configure description]
	 * @return [type] [description]
	 */
	public function output()
	{
		return $this->output;
	}

	public function comment($message)
	{
		$this->output()
			 ->writeln($message);
	}

	public function success($message)
	{
		$this->output()
			 ->writeln('<info>'.$message.'</info>');
	}

	public function warning($message)
	{
		$this->output()
			 ->writeln('<comment>'.$message.'</comment>');
	}

	public function info($message)
	{
		$this->output()
			 ->writeln('<question>'.$message.'</question>');
	}

	public function error($message)
	{
		$this->output()
			 ->writeln('<error>'.$message.'</error>');
	}
}
