<?php
namespace Germey\Emissary;

use ArrayAccess;

class Config implements ArrayAccess
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
	public function offsetSet($offset, $value)
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
	public function offsetExists($offset)
    {
        return isset($this->config[$offset]);
    }

	/**
	 * @param mixed $offset
	 */
	public function offsetUnset($offset)
    {
        unset($this->config[$offset]);
    }

	/**
	 * @param mixed $offset
	 * @return null
	 */
	public function offsetGet($offset)
    {
        return isset($this->config[$offset]) ? $this->config[$offset] : null;
    }
}