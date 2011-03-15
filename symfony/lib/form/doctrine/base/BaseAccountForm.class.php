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

		$this->setValidators(array(
			'id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
			'email' => new sfValidatorEmail(array('max_length' => 255)),
			'slug' => new neweValidatorSlug(),
			'password' => new sfValidatorString(array('max_length' => 255, 'min_length' => 5)),
			'culture' => new sfValidatorChoice(array(
				'multiple' => false,
				'choices' => sfConfig::get('app_cultures')
			)),
			'currency' => new sfValidatorChoice(array(
				'multiple' => false,
				'choices' => sfConfig::get('app_currencies')
			)),
		));
	}

	public function getModelName()
	{
		return 'Account';
	}
}
