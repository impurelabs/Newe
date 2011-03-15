<?php
/**
 * neweFrappRoute represents a route.
 *
 * @package    newe
 * @subpackage routing
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */

class neweFrappRoute extends sfRoute
{
	/**
	 * It adds to the route parameters array, the frapp slug, which is found in the subdomain.
	 *
	 * @param <type> $url
	 * @param <type> $context
	 * @return <type>
	 */
	public function matchesUrl($url, $context = array())
	{
		if (false === $parameters = parent::matchesUrl($url, $context)){
			return false;
		}

		// return false if the baseHost isn't found
		if (strpos($context['host'], $this->baseHost) === false){
				return false;
		}
		$subdomain = str_replace($this->baseHost, '', $context['host']);

		return array_merge(array('frapp_slug' => $subdomain), $parameters);
	}
}