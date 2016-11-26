<?php
namespace Germey\Emissary;

class Config
{
	/**
	 * @var
	 */
	protected $config;

	/**
	 * Config constructor.
	 *
	 * @param Emissary $emissary
	 */
	public function __construct(Emissary $emissary)
	{
		$this->config = $emissary->getApp()->getContainer()->get('settings')->all();
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function set($offset, $value)
	{
		if (is_null($offset)) {
			$this->config[] = $value;
		} else {
			$this->config[$offset] = $value;
		}
	}

	/**
	 * @param mixed $offset
	 * @return bool
	 */
	public function exists($offset)
	{
		return isset($this->config[$offset]);
	}

	/**
	 * @param mixed $offset
	 */
	public function drop($offset)
	{
		unset($this->config[$offset]);
	}

	/**
	 * @param mixed $offset
	 * @return null
	 */
	public function get($offset)
	{
		return isset($this->config[$offset]) ? $this->config[$offset] : null;
	}
	
}