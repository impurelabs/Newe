<?php

/**
* neweOsPatternRouting class controls the generation and parsing of URLs in the Os app.
*
* It parses and generates URLs by delegating the work to an array of sfRoute objects.
*
* @package		symfony
* @subpackage	routing
* @category		OsApp
* @author		Iulian Manea <iulian.manea@impurelabs.com>
*/
class neweOsPatternRouting extends newePatternRouting
{
	/**
	 * We only check the routes with the option app=os
	 */
	protected function getRouteThatMatchesUrl($url)
	{
		$this->ensureDefaultParametersAreSet();

		foreach ($this->routes as $name => $route) {
			/* Skip this route if it isn't for the os app */
			$options = $route->getOptions();
			if ($options['app'] != 'os'){
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
