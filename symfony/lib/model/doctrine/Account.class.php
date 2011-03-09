<?php

/**
 * Account
 * 
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
class Account extends BaseAccount
{
	/**
	* Sets the account password.
	*
	* @param string $password
	*/
	public function setPassword($password)
	{
		if (!$password && 0 == strlen($password)){
			return;
		}

		if (!$salt = $this->getSalt()){
			$salt = md5(rand(100000, 999999).$this->getUsername());
			$this->setSalt($salt);
		}

		$this->_set('password', sha1($salt.$password));
	}

	/**
	* Returns whether or not the given password is valid.
	*
	* @param string $password
	* @return boolean
	*/
	public function checkPassword($password)
	{
		return $this->getPassword() == sha1($this->getSalt().$password);
	}
}