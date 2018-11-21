<?php

namespace Chibi\Console\Core;

use Illuminate\Filesystem\Filesystem;

class TemplateGenerator
{
	/**
	 * [$template description]
	 * @var [type]
	 */
	public $template;

	/**
	 * [$templateContent description]
	 * @var [type]
	 */
	public $templateContent;

	/**
	 * [$templatePath description]
	 * @var [type]
	 */
	public $templatePath;

	/**
	 * [$basePath description]
	 * @var string
	 */
	public $basePath = 'packages/yumi/console/src';

	/**
	 * [$filesystem description]
	 * @var [type]
	 */
	protected $filesystem;

	/**
	 * [__construct description]
	 * @param [type] $templatePath [description]
	 */
	public function __construct($templatePath) 
	{
		$this->filesystem = new Filesystem();
		$this->template = $templatePath.".template";
		$this->setContent();
	}

	/**
	 * [generate description]
	 * @param  [type] $filename [description]
	 * @param  [type] $path     [description]
	 * @return [type]           [description]
	 */
	public function generate($filename, $path = null)
	{
		if (is_null($path)) {
			$path = base_path($this->basePath.'/Commands/');
		}
		$this->generateDirectories($path);
		if ($this->filesystem->exists($path.'/'.$filename)) {
			return false;
		}
		$this->filesystem->put($path.'/'.$filename, $this->templateContent);
		return true;
	}

	/**
	 * [generateDirectories description]
	 * @param  [type] $path [description]
	 * @return [type]       [description]
	 */
	protected function generateDirectories($path)
	{
		$path = str_replace(base_path(), '', $path);
		$directories = explode('/',$path);
		$dirname = '';
		if ($directories[0] == '') {
			unset($directories[0]);
		}
		foreach ($directories as $dir) {
			$dirname .= $dir;
			if (!$this->filesystem->isDirectory($dirname)) {
				$this->filesystem->makeDirectory($dirname);
			}
			$dirname .= '/';
		}
	}

	/**
	 * [replaceWith description]
	 * @param  [type] $key   [description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function replaceWith($key, $value) 
	{
		$this->templateContent = str_replace($key, $value, $this->templateContent );
		return $this;
	}

	/**
	 * [getContent description]
	 * @return [type] [description]
	 */
	public function getContent() 
	{
		return $this->templateContent;
	}

	/**
	 * [setContent description]
	 */
	private function setContent()
	{
		$this->templatePath = base_path($this->basePath.'/Templates/'.$this->template);
		if ($this->filesystem->exists($this->templatePath)) {
			$this->templateContent = $this->filesystem->get($this->templatePath);
		}
	}
}