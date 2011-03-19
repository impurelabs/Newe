<?php

/**
 * FrappMdl form base class.
 *
 * @method FrappMdl getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFrappMdlForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'slug'     => new sfWidgetFormInputText(),
      'name'     => new sfWidgetFormInputText(),
      'type_key' => new sfWidgetFormInputText(),
      'frapp_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Frapp'), 'add_empty' => false)),
      'position' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'slug'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'     => new sfValidatorString(array('max_length' => 100)),
      'type_key' => new sfValidatorString(array('max_length' => 10)),
      'frapp_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Frapp'))),
      'position' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'FrappMdl', 'column' => array('slug', 'frapp_id'))),
        new sfValidatorDoctrineUnique(array('model' => 'FrappMdl', 'column' => array('position', 'frapp_id'))),
      ))
    );

    $this->widgetSchema->setNameFormat('frapp_mdl[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FrappMdl';
  }

}
