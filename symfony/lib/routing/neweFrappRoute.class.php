<?php

/**
* neweFrappRoute represents a route that is Frapp aware.
*
* @package    newe
* @subpackage routing
* @author     Iulian Manea <iulian.manea@impurelabs.com>
*/
class neweFrappRoute extends sfRoute
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
		if (!isset($params['frapp_slug']) || $params['frapp_slug'] == ''){
			throw new sfException('Missing frap_slug parameter for the generation of a neweFrappRoute');
		}

		/* Removes the frapp_slug parameter, so it wouldn't be added in the variable query of the URL. */
		$frappSlug = $params['frapp_slug'];
		unset($params['frapp_slug']);

		/* Generates a URL from the given parameters. */
		$url = parent::generate($params, $context, $absolute);

		/* Adds the frontcontroller file, taking in accoun the current enviroment */
		switch(sfContext::getInstance()->getConfiguration()->getEnvironment()){
			case 'dev':
				$prefix = '/frapp_dev.php';
				break;
			case 'test':
				$prefix = '/frapp_test.php';
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

		/* Based on the frapp_slug parameter we generate the host. If the slug contains . it means that the slug is actually a domain */
		if (false !== strpos($frappSlug, '.')){
			$host = $frappSlug;
		} else {
			$host = $frappSlug . '.' . sfConfig::get('app_frapp_base_host');
		}

		if ($absolute && 0 !== strpos($url, 'http')){
			$url = 'http'.(isset($context['is_secure']) && $context['is_secure'] ? 's' : '').'://'. $host.$url;
		}

		return $url;
	}
}