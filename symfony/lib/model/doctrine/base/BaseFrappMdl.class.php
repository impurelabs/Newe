<?php

/**
* BaseFrappMdl
* 
* @package    newe
* @subpackage model
* @author     Iulian Manea <iulian.manea@impurelabs.com>
*/
abstract class BaseFrappMdl extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
	$this->setTableName('frapp_mdl');
	$this->hasColumn('id', 'integer', 4, array(
	'type' => 'integer',
	'primary' => true,
	'autoincrement' => true,
	'unsigned' => true,
	'length' => '4',
	));
	$this->hasColumn('slug', 'string', 100, array(
	'type' => 'string',
	'notnull' => true,
	'length' => '100',
	));
	$this->hasColumn('name', 'string', 100, array(
	'type' => 'string',
	'notnull' => true,
	'length' => '100',
	));
	$this->hasColumn('type_key', 'string', 10, array(
	'type' => 'string',
	'notnull' => true,
	'length' => '10',
	));
	$this->hasColumn('frapp_id', 'integer', 4, array(
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
		$this->hasOne('Frapp', array(
			'local' => 'frapp_id',
			'foreign' => 'id',
			'onDelete' => 'CASCADE',
			'onUpdate' => 'CASCADE'));

//		$this->hasMany('MdlPagesPage', array(
//			'local' => 'id',
//			'foreign' => 'mdl_id'));
//
//		$this->hasMany('MdlPhotosAlbum', array(
//			'local' => 'id',
//			'foreign' => 'mdl_id'));
//
//		$this->hasMany('MdlBlogPost', array(
//			'local' => 'id',
//			'foreign' => 'mdl_id'));
//
//		$this->hasMany('MDlGadgetsGadget', array(
//			'local' => 'id',
//			'foreign' => 'mdl_id'));

		$sluggable0 = new Doctrine_Template_Sluggable(array(
			'fields' => array(
			0 => 'name',
			),
			'uniqueBy' => array(
			0 => 'frapp_id',
			),
			'canUpdate' => true
		));
		$sortable0 = new Doctrine_Template_Sortable(array(
			'uniqueBy' => array(
				0 => 'frapp_id',
			),
		));
		$this->actAs($sluggable0);
		$this->actAs($sortable0);
	}
}