<?php

namespace Binocle\Support;

class Config
{
	/**
	 * Keeps all processed config data
	 * @var array
	 */
	private $config;

	/**
	 * Path object
	 * @var object
	 */
	private $path;

	/**
	 * Gets (extended) config
	 * @param  string $identifier
	 * @return array
	 */
	public function get($identifier)
	{
		if (!isset($this->configs[$identifier])) {
			$files = \Path::find('theme.config.' . $identifier, false);

			$config = array();
			foreach ($files as $file) {
				$fileContent = include($file);
				$fileContent = $fileContent ? $fileContent : array();
				$config = array_merge($config, $fileContent);
			}

			$this->config[$identifier] = $config;
		}

		return $this->config[$identifier];
	}
}
