<?php

/**
 * neweFrappNotFoundException is thrown when a Frapp, coresponding to the slug in the requested URL, is not found.
 *
 * @package		newe
 * @subpackage	exception
 * @category	FrappApp
 * @author		Iulian Manea <iulian.manea@impurelabs.com>
 */
	class neweFrappNotFoundException extends sfException
	{
	/**
	* Redirects to the osFrappNotFound route
	*/
	public function printStackTrace()
	{
		$exception = null === $this->wrappedException ? $this : $this->wrappedException;

		if (sfConfig::get('sf_debug')){
			$response = sfContext::getInstance()->getResponse();
			if (null === $response){
				$response = new sfWebResponse(sfContext::getInstance()->getEventDispatcher());
				sfContext::getInstance()->setResponse($response);
			}

			$response->setStatusCode(404);

			return parent::printStackTrace();
		} else {
			// log all exceptions in php log
			if (!sfConfig::get('sf_test')){
				error_log($this->getMessage());
			}

			$response->setStatusCode(404);
			sfContext::getInstance()->getController()->redirect('@osFrappNotFound');
		}
	}
}
