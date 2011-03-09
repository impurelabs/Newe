<?php

/**
 * Processes the "remember me" cookie.
 * 
 * This filter should be added to the application filters.yml file **above**
 * the security filter:
 * 
 *    remember_me:
 *      class: sfGuardRememberMeFilter
 * 
 *    security: ~
 */
class neweRememberMeFilter extends sfFilter
{
	/**
	* Executes the filter chain.
	*
	* @param sfFilterChain $filterChain
	*/
	public function execute($filterChain){
		$cookieName = sfConfig::get('app_user_remember_cookie_name', 'newe_remembers');

		if ($this->isFirstCall() && !$this->context->getUser()->isAuthenticated() && $cookie = $this->context->getRequest()->getCookie($cookieName)) {
			$q = Doctrine_Core::getTable('UserRememberKey')->createQuery('r')
				->innerJoin('r.User u')
				->where('r.remember_key = ?', $cookie);

			if ($q->count()) {
				$this->context->getUser()->signIn($q->fetchOne()->User);
			}
		}

		$filterChain->execute();
	}
}
