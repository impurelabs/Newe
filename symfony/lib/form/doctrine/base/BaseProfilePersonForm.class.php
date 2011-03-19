<?php

/**
 * ProfilePerson form base class.
 *
 * @method ProfilePerson getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfilePersonForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'    => new sfWidgetFormInputHidden(),
      'first_name'    => new sfWidgetFormInputText(),
      'last_name'     => new sfWidgetFormInputText(),
      'slogan'        => new sfWidgetFormInputText(),
      'date_of_birth' => new sfWidgetFormDate(),
      'gender'        => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'location_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'account_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('account_id')), 'empty_value' => $this->getObject()->get('account_id'), 'required' => false)),
      'first_name'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'slogan'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'date_of_birth' => new sfValidatorDate(array('required' => false)),
      'gender'        => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'), 'required' => false)),
      'location_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profile_person[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfilePerson';
  }

}
