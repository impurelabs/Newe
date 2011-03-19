<?php

/**
* newePatternRouting class controls the generation and parsing of URLs.
*
* It parses and generates URLs by delegating the work to an array of sfRoute objects.
*
* @package		symfony
* @subpackage	routing
* @category		FrappApp
* @author		Iulian Manea <iulian.manea@impurelabs.com>
*/
class newePatternRouting extends sfPatternRouting
{
	public function generate($name, $params = array(), $absolute = false)
	{
		/**
		 * Because we are working across multimple domains/subdomains we just force $absolute=true, so we don't run into trouble
		 * @author Iulian Manea <iulian.manea@impurelabs.com>
		 */
		$absolute = true;

		// fetch from cache
		if (null !== $this->cache){
			$cacheKey = 'generate_'.$name.'_'.md5(serialize(array_merge($this->defaultParameters, $params))).'_'.md5(serialize($this->options['context']));
			if ($this->options['lookup_cache_dedicated_keys'] && $url = $this->cache->get('symfony.routing.data.'.$cacheKey)){
				return $this->fixGeneratedUrl($url, $absolute);
			} elseif (isset($this->cacheData[$cacheKey])){
				return $this->fixGeneratedUrl($this->cacheData[$cacheKey], $absolute);
			}
		}

		if ($name){
			// named route
			if (!isset($this->routes[$name])){
				throw new sfConfigurationException(sprintf('The route "%s" does not exist.', $name));
			}
			$route = $this->routes[$name];
			$this->ensureDefaultParametersAreSet();
		} else {
			// find a matching route
			if (false === $route = $this->getRouteThatMatchesParameters($params, $this->options['context'])){
				throw new sfConfigurationException(sprintf('Unable to find a matching route to generate url for params "%s".', is_object($params) ? 'Object('.get_class($params).')' : str_replace("\n", '', var_export($params, true))));
			}
		}

		$url = $route->generate($params, $this->options['context'], $absolute);

		// store in cache
		if (null !== $this->cache){
			if ($this->options['lookup_cache_dedicated_keys']){
				$this->cache->set('symfony.routing.data.'.$cacheKey, $url);
			} else {
				$this->cacheChanged = true;
				$this->cacheData[$cacheKey] = $url;
			}
		}

		return $url;
	}

	protected function neweFixGeneratedUrl($url, $params, $options, $absolute = true)
	{
		if (isset($this->options['context']['prefix'])){
			if (0 === strpos($url, 'http')){
				$url = preg_replace('#https?\://[^/]+#', '$0'.$this->options['context']['prefix'], $url);
			} else {
				$url = $this->options['context']['prefix'].$url;
			}
		}

		/* According to the app option we generate the host*/		
		if ($options['app'] == 'frapp'){
			$host = $params['frapp_slug'] . '.' . $this->options['os_host'];
		} elseif ($options['app'] == 'os') {
			$host = $this->options['frapp_host'];
		} else {
			throw new sfException('Invalid app option specified for url ' . $url);
		}

		if ($absolute && 0 !== strpos($url, 'http')){
			$url = 'http'.(isset($this->options['context']['is_secure']) && $this->options['context']['is_secure'] ? 's' : '').'://'. $host.$url;
		}

		return $url;
	}
}
