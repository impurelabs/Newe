<?php

/**
 * public actions.
 * @package    newe
 * @subpackage action
 * @category OsApp
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
class publicActions extends sfActions
{
	/**
	* Executes test action
	*
	* @param sfRequest $request A request object
	*/
	public function executeTest(sfWebRequest $request)
	{
		die('in testul public');
	}
}
