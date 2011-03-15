<?php
/**
* neweOsSecurityFilter checks if the user is authenticated, and if not it will redirect him to the login action.
* It also ignores the secutiry check for the public module
*
* @package    newe
* @subpackage filter
* @author     Iulian Manea <iulian.manea@impurelabs.com>
*/
class neweFrappSecurityFilter extends sfFilter
{
	/**
	* Executes this filter.
	*
	* @param sfFilterChain $filterChain A sfFilterChain instance
	*/
	public function execute($filterChain)
	{
		// disable security on login actions
		if (sfConfig::get('sf_login_module') == $this->context->getModuleName() && sfConfig::get('sf_login_action') == $this->context->getActionName()){
			$filterChain->execute();

			return;
		}

		// NOTE: the nice thing about the Action class is that getCredential()
		//       is vague enough to describe any level of security and can be
		//       used to retrieve such data and should never have to be altered
		if (!$this->context->getUser()->isAuthenticated()){
			if (sfConfig::get('sf_logging_enabled')){
				$this->context->getEventDispatcher()->notify(new sfEvent($this, 'application.log', array(sprintf('Action "%s/%s" requires authentication, forwarding to "%s/%s"', $this->context->getModuleName(), $this->context->getActionName(), sfConfig::get('sf_login_module'), sfConfig::get('sf_login_action')))));
			}

			// the user is not authenticated
			$this->redirectToLoginAction();
		}

		// the user is authenticated, continue
		$filterChain->execute();
	}

	/**
	* Forwards the current request to the login action.
	*
	* @throws sfStopException
	*/
	protected function redirectToLoginAction()
	{
		$this->context->getController()->redirect('@osLogin');

		throw new sfStopException();
	}
}
