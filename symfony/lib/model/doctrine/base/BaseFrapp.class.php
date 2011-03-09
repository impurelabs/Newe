<?php

/**
* BaseFrapp
* 
* @package    Emoapp
* @subpackage model
* @author     Iulian Manea <iulian.manea@impurelabs.com>
*/
abstract class BaseFrapp extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('frapp');
		$this->hasColumn('id', 'integer', 4, array(
			'type' => 'integer',
			'primary' => true,
			'autoincrement' => true,
			'unsigned' => true,
			'length' => '4',
		));
		$this->hasColumn('name', 'string', 50, array(
			'type' => 'string',
			'notnull' => true,
			'length' => '50',
		));
		$this->hasColumn('admins', 'array', 1000);
		$this->hasColumn('slug', 'string', 250, array(
			'type' => 'string',
			'notnull' => true,
			'unique' => true,
			'length' => '250',
		));
		$this->hasColumn('slogan', 'string', 250, array(
			'type' => 'string',
			'length' => '250',
		));
		$this->hasColumn('state', 'enum', null, array(
			'type' => 'enum',
			'values' =>
			array(
				0 => '0',
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
			),
			'notnull' => true,
		));
		$this->hasColumn('filename', 'string', 255, array(
			'type' => 'string',
			'length' => '255',
		));
		$this->hasColumn('logo_x1', 'integer', 2, array(
			'type' => 'integer',
			'length' => '2',
		));
		$this->hasColumn('logo_y1', 'integer', 2, array(
			'type' => 'integer',
			'length' => '2',
		));
		$this->hasColumn('logo_x2', 'integer', 2, array(
			'type' => 'integer',
			'length' => '2',
		));
		$this->hasColumn('logo_y2', 'integer', 2, array(
			'type' => 'integer',
			'length' => '2',
		));
		$this->hasColumn('sourceimage_w', 'integer', 2, array(
			'type' => 'integer',
			'length' => '2',
		));
		$this->hasColumn('sourceimage_h', 'integer', 2, array(
			'type' => 'integer',
			'length' => '2',
		));
		$this->hasColumn('state_support_sponsor', 'integer', 1, array(
			'type' => 'integer',
			'unsigned' => true,
			'default' => 0,
			'length' => '1',
		));
		$this->hasColumn('sponsor_accept_pledge', 'integer', 1, array(
			'type' => 'integer',
			'unsigned' => true,
			'default' => 0,
			'length' => '1',
		));
		$this->hasColumn('sponsor_goal', 'integer', 1, array(
			'type' => 'integer',
			'unsigned' => true,
			'default' => 0,
		));
		$this->hasColumn('state_support_campaign', 'integer', 1, array(
			'type' => 'integer',
			'unsigned' => true,
			'default' => 0,
			'length' => '1',
		));
		$this->hasColumn('campaign_raise_money', 'integer', 1, array(
			'type' => 'integer',
			'unsigned' => true,
			'default' => 0,
			'length' => '1',
		));
		$this->hasColumn('state_support_promote', 'integer', 1, array(
			'type' => 'integer',
			'unsigned' => true,
			'default' => 0,
			'length' => '1',
		));
		$this->hasColumn('state_support_petition', 'integer', 1, array(
			'type' => 'integer',
			'unsigned' => true,
			'default' => 0,
			'length' => '1',
		));
		$this->hasColumn('parent_id', 'integer', 4, array(
			'type' => 'integer',
			'unsigned' => true,
			'length' => '4',
		));
		$this->hasColumn('expires_at', 'date', null, array(
			'type' => 'date'
		));
		$this->hasColumn('creator_id', 'integer', 4, array(
			'type' => 'integer',
			'notnull' => true,
			'unsigned' => true,
			'length' => '4',
		));

		$this->option('symfony', array(
			'filter' => false,
		));
	}

	public function setUp()
	{
		parent::setUp();
		$this->hasOne('Account as Creator', array(
			'local' => 'creator_id',
			'foreign' => 'id',
			'onDelete' => 'CASCADE'));

		$this->hasMany('FrappMdl', array(
			'local' => 'id',
			'foreign' => 'frapp_id'));

//		$this->hasMany('RespTag', array(
//			'refClass' => 'RespTaggedFrapp',
//			'local' => 'frapp_id',
//			'foreign' => 'tag_id',
//			'onDelete' => 'CASCADE'));

//		$this->hasMany('PromotedVisitor', array(
//			'local' => 'id',
//			'foreign' => 'frapp_id'));
//
//		$this->hasMany('Support_PromotionBanner', array(
//			'local' => 'id',
//			'foreign' => 'microsite_id'));
//
//		$this->hasMany('SponsoredSum', array(
//			'local' => 'id',
//			'foreign' => 'frapp_id'));

		$timestampable0 = new Doctrine_Template_Timestampable(array(
			'updated' => array(
			'disabled' => true
		)
		));
		$this->actAs($timestampable0);
	}
}