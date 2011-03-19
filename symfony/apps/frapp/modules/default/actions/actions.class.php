<?php

/**
 * default actions.
 *
 * @package		newe
 * @subpackage	actions
 * @category	FrappApp
 * @author		Iulian Manea <iulian.manea@impurelabs.com>
 */
class defaultActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$routes = $this->getContext()->getRouting()->getRoutes();
	}

	public function executeTetul(sfWebRequest $request)
	{

		echo '<pre>';
	}
}
