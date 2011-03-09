<?php

/**
 * BaseUserForgotPassword
 * 
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com
 */
abstract class BaseUserForgotPassword extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('user_forgot_password');
		$this->hasColumn('user_id', 'integer', null, array(
			'type' => 'integer',
			'notnull' => true,
		));
		$this->hasColumn('unique_key', 'string', 255, array(
			'type' => 'string',
			'length' => 255,
		));
		$this->hasColumn('expires_at', 'timestamp', null, array(
			'type' => 'timestamp',
			'notnull' => true,
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