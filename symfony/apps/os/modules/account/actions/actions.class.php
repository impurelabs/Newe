<?php

/**
 * account actions.
 *
 * @package		newe
 * @subpackage	actions
 * @category	OsApp
 * @author		Iulian Manea <iulian.manea@impurelabs.com>
 */
class accountActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogin(sfWebRequest $request)
	{
		$user = $this->getUser();
		if ($user->isAuthenticated()){
			return $this->redirect('@os_webtop');
		}

		$this->form = new LoginForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
			$values = $this->form->getValues();
			if ($this->form->isValid()){
				$values = $this->form->getValues();
				$this->getUser()->signin($values['account'], array_key_exists('remember', $values) ? $values['remember'] : false);

				$signinUrl = $user->getReferer($request->getReferer());

				return $this->redirect('' != $signinUrl ? $signinUrl : '@os_webtop');
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

	public function executeLogout($request)
	{
		$this->getUser()->signOut();

		$this->redirect('@login');
	}

	public function executePrivata($request)
	{
		die('in privata');
	}
}
