<?php

/**
 *
 * @package    newe
 * @subpackage validator
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
class neweValidatorLogin extends sfValidatorBase
{
	public function configure($options = array(), $messages = array())
	{
		$this->setMessage('invalid', 'The login details are invalid.');
	}

	protected function doClean($values)
	{
		$email = $values['email'];
		$password = $values['password'];

		// don't allow to sign in with an empty email
		if ($email){
			$account = AccountTable::getInstance()->findOneByEmail($email);

			// user exists?
			if($account){
				// password is ok?
				if ($account->checkPassword($password)){
					return array_merge($values, array('account' => $account));
				}
			}
		}

		throw new sfValidatorError($this, 'invalid');
	}
}
