<?php

/**
 * AccountForgotPassword form base class.
 *
 * @method AccountForgotPassword getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountForgotPasswordForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => false)),
      'unique_key' => new sfWidgetFormInputHidden(),
      'expires_at' => new sfWidgetFormDateTime(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'account_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'))),
      'unique_key' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('unique_key')), 'empty_value' => $this->getObject()->get('unique_key'), 'required' => false)),
      'expires_at' => new sfValidatorDateTime(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('account_forgot_password[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountForgotPassword';
  }

}
