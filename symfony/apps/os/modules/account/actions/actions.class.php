<?php

/**
* account actions.
*
* @package    newe
* @subpackage user
* @author     Iulian Manea <iulian.manea@impurelabs.com>
*/
class accountActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeSignin(sfWebRequest $request)
	{
		$user = $this->getUser();
		if ($user->isAuthenticated()){
			return $this->redirect('@webtop');
		}

		$this->form = new AccountSigninForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid()){
				$values = $this->form->getValues();
				$this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

				$signinUrl = $user->getReferer($request->getReferer());

				return $this->redirect('' != $signinUrl ? $signinUrl : '@webtop');
			}
		} else {
			// if we have been forwarded, then the referer is the current URL
			// if not, this is the referer of the current request
			$user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

			$module = sfConfig::get('sf_login_module');
			if ($this->getModuleName() != $module){
				return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
			}

			$this->getResponse()->setStatusCode(401);
		}
	}

	public function executeSignout($request)
	{
		$this->getUser()->signOut();

		$this->redirect('@login');
	}
}
