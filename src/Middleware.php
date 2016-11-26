<?php
namespace Germey\Emissary;

use Illuminate\Support\Facades\Facade;

class Middleware
{
	/**
	 * @var array
	 */
	protected $providers;
	/**
	 * @var array
	 */
	protected $aliases;

	/**
	 * Middleware constructor.
	 *
	 * @param array $providers
	 * @param array $aliases
	 */
	public function __construct($providers = [], $aliases = [])
	{
		$this->providers = $providers;
		$this->aliases = $aliases;
	}

	/**
	 * @param $request
	 * @param $response
	 * @param $next
	 * @return mixed
	 */
	public function __invoke($request, $response, $next)
	{
		$emissary = new Emissary($next);
		$emissary->addProviders(array_merge(['Germey\Emissary\ConfigServiceProvider'], $this->providers));

		Facade::setFacadeApplication($next->getContainer());
		$emissary->addAliases($this->aliases);

		return $next($request, $response);
	}
}