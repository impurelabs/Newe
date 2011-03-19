<?php

/**
 * Frapp form base class.
 *
 * @method Frapp getObject() Returns the current form's model object
 *
 * @package    newe
 * @subpackage form
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFrappForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInputText(),
      'admins'                 => new sfWidgetFormInputText(),
      'slug'                   => new sfWidgetFormInputText(),
      'slogan'                 => new sfWidgetFormInputText(),
      'state'                  => new sfWidgetFormInputText(),
      'filename'               => new sfWidgetFormInputText(),
      'logo_x1'                => new sfWidgetFormInputText(),
      'logo_y1'                => new sfWidgetFormInputText(),
      'logo_x2'                => new sfWidgetFormInputText(),
      'logo_y2'                => new sfWidgetFormInputText(),
      'sourceimage_w'          => new sfWidgetFormInputText(),
      'sourceimage_h'          => new sfWidgetFormInputText(),
      'state_support_sponsor'  => new sfWidgetFormInputText(),
      'sponsor_accept_pledge'  => new sfWidgetFormInputText(),
      'sponsor_goal'           => new sfWidgetFormInputText(),
      'state_support_campaign' => new sfWidgetFormInputText(),
      'campaign_raise_money'   => new sfWidgetFormInputText(),
      'state_support_promote'  => new sfWidgetFormInputText(),
      'state_support_petition' => new sfWidgetFormInputText(),
      'parent_id'              => new sfWidgetFormInputText(),
      'creator_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => false)),
      'skin_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Skin'), 'add_empty' => false)),
      'created_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 50)),
      'admins'                 => new sfValidatorPass(array('required' => false)),
      'slug'                   => new sfValidatorString(array('max_length' => 250)),
      'slogan'                 => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'state'                  => new sfValidatorString(array('max_length' => 255)),
      'filename'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'logo_x1'                => new sfValidatorInteger(array('required' => false)),
      'logo_y1'                => new sfValidatorInteger(array('required' => false)),
      'logo_x2'                => new sfValidatorInteger(array('required' => false)),
      'logo_y2'                => new sfValidatorInteger(array('required' => false)),
      'sourceimage_w'          => new sfValidatorInteger(array('required' => false)),
      'sourceimage_h'          => new sfValidatorInteger(array('required' => false)),
      'state_support_sponsor'  => new sfValidatorPass(array('required' => false)),
      'sponsor_accept_pledge'  => new sfValidatorPass(array('required' => false)),
      'sponsor_goal'           => new sfValidatorInteger(array('required' => false)),
      'state_support_campaign' => new sfValidatorPass(array('required' => false)),
      'campaign_raise_money'   => new sfValidatorPass(array('required' => false)),
      'state_support_promote'  => new sfValidatorPass(array('required' => false)),
      'state_support_petition' => new sfValidatorPass(array('required' => false)),
      'parent_id'              => new sfValidatorInteger(array('required' => false)),
      'creator_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'))),
      'skin_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Skin'))),
      'created_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('frapp[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Frapp';
  }

}
