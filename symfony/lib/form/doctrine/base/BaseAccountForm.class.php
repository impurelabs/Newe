<?php

/**
 * Account form base class.
 *
 * @method Account getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'email'           => new sfWidgetFormInputText(),
      'slug'            => new sfWidgetFormInputText(),
      'salt'            => new sfWidgetFormInputText(),
      'password'        => new sfWidgetFormInputText(),
      'state'           => new sfWidgetFormInputText(),
      'last_login'      => new sfWidgetFormDateTime(),
      'validation_code' => new sfWidgetFormInputText(),
      'culture'         => new sfWidgetFormInputText(),
      'currency'        => new sfWidgetFormInputText(),
      'type'            => new sfWidgetFormInputText(),
      'is_designer'     => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'email'           => new sfValidatorString(array('max_length' => 255)),
      'slug'            => new sfValidatorString(array('max_length' => 255)),
      'salt'            => new sfValidatorString(array('max_length' => 255)),
      'password'        => new sfValidatorString(array('max_length' => 255)),
      'state'           => new sfValidatorString(array('max_length' => 255)),
      'last_login'      => new sfValidatorDateTime(array('required' => false)),
      'validation_code' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'culture'         => new sfValidatorString(array('max_length' => 3)),
      'currency'        => new sfValidatorString(array('max_length' => 3)),
      'type'            => new sfValidatorString(array('max_length' => 255)),
      'is_designer'     => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }

}
