<?php

/**
*
* @package    newe
* @subpackage validator
* @author     Iulian Manea <iulian.manea@impurelabs.com>
*/
class ValidatorAccountSignin extends sfValidatorBase
{
	public function configure($options = array(), $messages = array())
	{
		$this->setMessage('invalid', 'The login details are invalid.');
	}

	protected function doClean($values)
	{
		$email = $values['email'];
		$password = $values['password'];

		// don't allow to sign in with an empty username
		if ($email){
			$account = AccountTable::getInstance()->findOneByEmail($email);

			// user exists?
			if($account){
				// password is ok?
				if ($user->checkPassword($password)){
					return array_merge($values, array('user' => $user));
				}
			}
		}

		if ($this->getOption('throw_global_error')){
			throw new sfValidatorError($this, 'invalid');
		}
	}
}
