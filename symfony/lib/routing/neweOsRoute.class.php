<?php

/**
* neweOsRoute represents a route that is Os aware.
*
* @package    newe
* @subpackage routing
* @author     Iulian Manea <iulian.manea@impurelabs.com>
*/
class neweOsRoute extends sfRoute
{
	/**
	 * Generates a URL from the given parameters.
	 *
	 * @param  mixed   $params    The parameter values
	 * @param  array   $context   The context
	 * @param  Boolean $absolute  Whether to generate an absolute URL
	 *
	 * @return string The generated URL
	 */
	public function generate($params, $context = array(), $absolute = true)
	{
		/* Generates a URL from the given parameters. */
		$url = parent::generate($params, $context, $absolute);

		/* Adds the frontcontroller file, taking in accoun the current enviroment */
		switch(sfContext::getInstance()->getConfiguration()->getEnvironment()){
			case 'dev':
				$prefix = '/os_dev.php';
				break;
			case 'test':
				$prefix = '/os_test.php';
				break;
			case 'prod':
				$prefix = '';
				break;
		}
		
		if (isset($prefix) && $prefix != ''){
			if (0 === strpos($url, 'http')){
				$url = preg_replace('#https?\://[^/]+#', '$0' . $prefix, $url);
			} else {
				$url = $prefix . $url;
			}
		}

		/* We add the host */
		if ($absolute && 0 !== strpos($url, 'http')){
			$url = 'http'.(isset($context['is_secure']) && $context['is_secure'] ? 's' : '').'://'. sfConfig::get('app_os_base_host') .$url;
		}

		return $url;
	}
}