<?php

/**
 * AccountRememberKey form base class.
 *
 * @method AccountRememberKey getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountRememberKeyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => false)),
      'remember_key' => new sfWidgetFormInputHidden(),
      'ip_address'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'account_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'))),
      'remember_key' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('remember_key')), 'empty_value' => $this->getObject()->get('remember_key'), 'required' => false)),
      'ip_address'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('account_remember_key[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountRememberKey';
  }

}
