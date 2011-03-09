<?php

/**
 * Description of BaseAccountForm
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class BaseAccountForm extends BaseFormDoctrine
{
	public function setup()
	{
		$this->setWidgets(array(
			'id' => new sfWidgetFormInputHidden(),
			'email' => new sfWidgetFormInputText(),
			'slug' => new sfWidgetFormInputText(),
			'password' => new sfWidgetFormInputPassword(array('type' => 'password')),
			'culture' => new sfWidgetFormChoice(array(
				'choices' => sfConfig::get('app_cultures'),
				'multiple' => false,
				'expanded' => false
			)),
			'currency' => new sfWidgetFormChoice(array(
				'choices' => sfConfig::get('app_currencies'),
				'multiple' => false,
				'expanded' => false
			)),
		));
	}

	public function getModelName()
	{
		return 'Account';
	}
}
