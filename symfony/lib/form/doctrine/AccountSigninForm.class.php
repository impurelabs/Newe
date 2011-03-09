<?php

/**
 * AccountSigninForm
 *
 * @author Iulian Manea
 */
class AccountSigninForm extends BaseAccountForm
{
	public function setup()
	{
		$this->useFields(array('username', 'password'));

		$this->widgetSchema['remember'] = new sfWidgetFormInputCheckbox();
		$this->validatorSchema['remember'] = new sfValidatorBoolean();

		$this->validatorSchema->setPostValidator(new ValidatorAccountSignin());

		$this->widgetSchema->setNameFormat('account_signin[%s]');
	}
}