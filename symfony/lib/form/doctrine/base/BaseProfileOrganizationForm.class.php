<?php

/**
 * ProfileOrganization form base class.
 *
 * @method ProfileOrganization getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfileOrganizationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'        => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'brand_name'        => new sfWidgetFormInputText(),
      'slogan'            => new sfWidgetFormInputText(),
      'cui'               => new sfWidgetFormInputText(),
      'contact_name'      => new sfWidgetFormInputText(),
      'contact_job_title' => new sfWidgetFormInputText(),
      'contact_email'     => new sfWidgetFormInputText(),
      'contact_phone'     => new sfWidgetFormInputText(),
      'location_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'account_id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('account_id')), 'empty_value' => $this->getObject()->get('account_id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 100)),
      'brand_name'        => new sfValidatorString(array('max_length' => 100)),
      'slogan'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'cui'               => new sfValidatorString(array('max_length' => 100)),
      'contact_name'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'contact_job_title' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'contact_email'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'contact_phone'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'location_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profile_organization[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfileOrganization';
  }

}
