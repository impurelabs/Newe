<?php

/**
 * BaseUserRememberKey
 * 
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
abstract class BaseUserRememberKey extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('user_remember_key');
		$this->hasColumn('user_id', 'integer', null, array(
			'type' => 'integer',
		));
		$this->hasColumn('remember_key', 'string', 32, array(
			'type' => 'string',
			'primary' => true,
			'length' => 32,
		));
		$this->hasColumn('ip_address', 'string', 50, array(
			'type' => 'string',
			'length' => 50,
		));

		$this->option('symfony', array(
			'form' => false,
			'filter' => false,
		));
	}

	public function setUp()
	{
		parent::setUp();
		$this->hasOne('User', array(
			'local' => 'user_id',
			'foreign' => 'id',
			'onDelete' => 'CASCADE'
		));

		$timestampable0 = new Doctrine_Template_Timestampable(array());
		$this->actAs($timestampable0);
	}
}