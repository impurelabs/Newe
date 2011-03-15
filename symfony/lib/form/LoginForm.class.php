<?php

/**
 * LoginForm
 *
 * @package newe
 * @subpackage form
 * @author Iulian Manea
 */
class LoginForm extends BaseForm
{
	public function setup()
	{
		$this->setWidgets(array(
			'email' => new sfWidgetFormInputText(),
			'password' => new sfWidgetFormInputPassword(array('type' => 'password')),
			'remember' => new sfWidgetFormInputCheckbox(),
		));

		$this->setValidators(array(
			'email' => new sfValidatorString(),
			'password' => new sfValidatorString(),
			'remember' => new sfValidatorBoolean(),
		));

		$this->validatorSchema->setPostValidator(new neweValidatorLogin());

		$this->widgetSchema->setNameFormat('login[%s]');
	}
}