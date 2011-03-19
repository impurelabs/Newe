<?php

/**
* neweFrappPatternRouting class controls the generation and parsing of URLs in the Frapp app.
*
* It parses and generates URLs by delegating the work to an array of sfRoute objects.
*
* @package		symfony
* @subpackage	routing
* @category		FrappApp
* @author		Iulian Manea <iulian.manea@impurelabs.com>
*/
class neweFrappPatternRouting extends newePatternRouting
{
	/**
	 * We only check the routes of the class neweFrappRoute
	 */
	protected function getRouteThatMatchesUrl($url)
	{
		$this->ensureDefaultParametersAreSet();

		foreach ($this->routes as $name => $route) {
			/* Skip this route if it isn't for the frapp app */
			$options = $route->getOptions();
			if ($options['app'] != 'frapp'){
				continue;
			}

			if (false === $parameters = $route->matchesUrl($url, $this->options['context'])) {
				continue;
			}

			return array('name' => $name, 'pattern' => $route->getPattern(), 'parameters' => $parameters);
		}

		return false;
	}
}
