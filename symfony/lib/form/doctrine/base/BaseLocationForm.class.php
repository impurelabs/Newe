<?php

/**
 * Location form base class.
 *
 * @method Location getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'city'       => new sfWidgetFormInputText(),
      'region'     => new sfWidgetFormInputText(),
      'country'    => new sfWidgetFormInputText(),
      'lang'       => new sfWidgetFormInputText(),
      'population' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'city'       => new sfValidatorString(array('max_length' => 100)),
      'region'     => new sfValidatorString(array('max_length' => 100)),
      'country'    => new sfValidatorString(array('max_length' => 2)),
      'lang'       => new sfValidatorString(array('max_length' => 2)),
      'population' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Location';
  }

}
