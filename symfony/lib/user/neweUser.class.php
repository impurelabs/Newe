<?php


class neweUser extends sfUser implements sfSecurityUser
{
	const LAST_REQUEST_NAMESPACE = 'newe/user/lastRequest';
	const AUTH_NAMESPACE = 'newe/user/authenticated';
	const ATTRIBUTE_NAMESPACE = 'newe/user/attributes';
	const CULTURE_NAMESPACE = 'newe/user/culture';

	protected $account = null;
	protected $lastRequest = null;
	protected $authenticated = null;
	protected $timedout = false;


	/**
	* Available options:
	*
	*  * timeout: Timeout to automatically log out the user in seconds (1800 by default)
	*             Set to false to disable
	*
	* @param sfEventDispatcher $dispatcher  An sfEventDispatcher instance.
	* @param sfStorage         $storage     An sfStorage instance.
	* @param array             $options     An associative array of options.
	*
	* @see sfUser
	*/
	public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
	{
		// initialize parent
		parent::initialize($dispatcher, $storage, $options);

		if (!array_key_exists('timeout', $this->options)){
			$this->options['timeout'] = 1800;
		}

		// force the max lifetime for session garbage collector to be greater than timeout
		if (ini_get('session.gc_maxlifetime') < $this->options['timeout']){
			ini_set('session.gc_maxlifetime', $this->options['timeout']);
		}

		// read data from storage
		$this->authenticated = $storage->read(self::AUTH_NAMESPACE);
		$this->lastRequest   = $storage->read(self::LAST_REQUEST_NAMESPACE);

		if (null === $this->authenticated){
			$this->authenticated = false;
			$this->credentials   = array();
		} else {
			// Automatic logout logged in user if no request within timeout parameter seconds
			$timeout = $this->options['timeout'];
			if (false !== $timeout && null !== $this->lastRequest && time() - $this->lastRequest >= $timeout){
				if ($this->options['logging']){
					$this->dispatcher->notify(new sfEvent($this, 'application.log', array('Automatic user logout due to timeout')));
				}

				$this->setTimedOut();
				$this->setAuthenticated(false);
			}
		}

		$this->lastRequest = time();

		if (!$this->isAuthenticated()){
			// remove user if timeout
			$this->getAttributeHolder()->removeNamespace('neweUser');
			$this->user = null;
		}
	}

	/**
	* Signs in the user on the application.
	*
	* @param Account $account The Account id
	* @param boolean $remember Whether or not to remember the user
	* @param Doctrine_Connection $con A Doctrine_Connection object
	*/
	public function signIn($account, $remember = false, $con = null)
	{
		// signin
		$this->setAttribute('account_id', $account->getId(), 'neweUser');
		$this->setAttribute('appbar', $account->getAppbar(), 'neweUser');
		$this->setAuthenticated(true);

		// save last login
		$account->setLastLogin(date('Y-m-d H:i:s'));
		$account->save($con);

		// remember?
		if ($remember){
			$expiration_age = sfConfig::get('app_user_remember_key_expiration_age', 15 * 24 * 3600);

			// remove old keys or other keys from this account
			Doctrine_Core::getTable('AccountRememberKey')->createQuery()
				->delete()
				->where('created_at < ? OR Account_id = ?', array(date('Y-m-d H:i:s', time() - $expiration_age), $Account->getId()))
				->execute();

			// generate new keys
			$key = $this->generateRandomKey();

			// save key
			$rk = new AccountRememberKey();
			$rk->setRememberKey($key);
			$rk->setAccountId($account->getId());
			$rk->setIpAddress($_SERVER['REMOTE_ADDR']);
			$rk->save($con);

			// make key as a cookie
			$remember_cookie = sfConfig::get('app_user_remember_cookie_name', 'newe_remembers');
			sfContext::getInstance()->getResponse()->setCookie($remember_cookie, $key, time() + $expiration_age);
		}
	}

	/**
	* Returns a random generated key.
	*
	* @param int $len The key length
	* @return string
	*/
	protected function generateRandomKey($len = 20)
	{
		return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
	}

	/**
	* Signs out the user.
	*
	*/
	public function signOut()
	{
		$this->getAttributeHolder()->removeNamespace('neweUser');
		$this->account = null;
		$this->setAuthenticated(false);
		$expiration_age = sfConfig::get('app_user_remember_key_expiration_age', 15 * 24 * 3600);
		$remember_cookie = sfConfig::get('app_user_remember_cookie_name', 'newe_remembers');
		sfContext::getInstance()->getResponse()->setCookie($remember_cookie, '', time() - $expiration_age);
	}

	/**
	* Returns the related Account object.
	*
	* @return Account
	*/
	public function getAccount()
	{
		if (!$this->account && $id = $this->getAttribute('account_id', null, 'neweUser')){
			$this->account = AccountTable::getInstance()->findOneById($id);

			if (!$this->account){
				// the account does not exist anymore in the database
				$this->signOut();

				throw new sfException('The account does not exist anymore in the database.');
			}
		}

		return $this->account;
	}

	/**
	* Sets the account's password.
	*
	* @param string $password The password
	* @param Doctrine_Collection $con A Doctrine_Connection object
	*/
	public function setPassword($password, $con = null)
	{
		$this->getAccount()->setPassword($password);
		$this->getAccount()->save($con);
	}

	/**
	* Returns whether or not the given password is valid.
	*
	* @return boolean
	*/
	public function checkPassword($password)
	{
		return $this->getAccount()->checkPassword($password);
	}

	/**
	* Returns true if user is authenticated.
	*
	* @return boolean
	*/
	public function isAuthenticated()
	{
		return $this->authenticated;
	}

	/**
	* Sets authentication for user.
	*
	* @param  bool $authenticated
	*/
	public function setAuthenticated($authenticated)
	{
		if ($this->options['logging']){
			$this->dispatcher->notify(new sfEvent($this, 'application.log', array(sprintf('User is %sauthenticated', $authenticated === true ? '' : 'not '))));
		}

		if ((bool) $authenticated !== $this->authenticated){
			if ($authenticated === true){
				$this->authenticated = true;
			} else {
				$this->authenticated = false;
				$this->clearCredentials();
			}

			$this->dispatcher->notify(new sfEvent($this, 'user.change_authentication', array('authenticated' => $this->authenticated)));

			$this->storage->regenerate(false);
		}
	}

	public function setTimedOut()
	{
		$this->timedout = true;
	}

	public function isTimedOut()
	{
		return $this->timedout;
	}

	/**
	* Returns the timestamp of the last user request.
	*
	* @return  int
	*/
	public function getLastRequestTime()
	{
		return $this->lastRequest;
	}

	public function shutdown()
	{
		// write the last request time to the storage
		$this->storage->write(self::LAST_REQUEST_NAMESPACE, $this->lastRequest);
		$this->storage->write(self::AUTH_NAMESPACE,         $this->authenticated);

		// call the parent shutdown method
		parent::shutdown();
	}

	/**
	* Returns the referer uri.
	*
	* @param string $default The default uri to return
	* @return string $referer The referer
	*/
	public function getReferer($default)
	{
		$referer = $this->getAttribute('referer', $default);
		$this->getAttributeHolder()->remove('referer');

		return $referer;
	}

	/**
	* Sets the referer.
	*
	* @param string $referer
	*/
	public function setReferer($referer)
	{
		if (!$this->hasAttribute('referer')){
			$this->setAttribute('referer', $referer);
		}
	}
}
