<?php

/**
 * BaseUser
 *
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
abstract class BasesfGuardUser extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('user');
		$this->hasColumn('id', 'integer', 4, array(
			'type' => 'integer',
			'primary' => true,
			'autoincrement' => true,
			'unsigned' => true,
			'length' => '4',
		));
		$this->hasColumn('email', 'string', 255, array(
			'type' => 'string',
			'notnull' => true,
			'unique' => true,
			'email' => true,
			'length' => '255',
		));
		$this->hasColumn('slug', 'string', 255, array(
			'type' => 'string',
			'notnull' => true,
			'unique' => true,
			'length' => '255',
		));
		$this->hasColumn('salt', 'string', 255, array(
			'type' => 'string',
			'length' => 255,
			'notnull' => true,
		));
		$this->hasColumn('password', 'string', 255, array(
			'type' => 'string',
			'length' => 255,
			'minlength' => 5,
			'notnull' => true,
		));
		$this->hasColumn('state', 'enum', null, array(
			'type' => 'enum',
			'values' =>
			array(
			0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'
			),
			'notnull' => true,
		));
		$this->hasColumn('last_login', 'timestamp', null, array(
			'type' => 'timestamp',
			'notnull' => true,
		));
		$this->hasColumn('validation_code', 'string', 45, array(
			'type' => 'string',
			'length' => 45,
		));
		$this->hasColumn('culture', 'string', 3, array(
			'type' => 'string',
			'length' => 3,
			'notnull' => true,
		));
		$this->hasColumn('currency', 'string', 3, array(
			'type' => 'string',
			'length' => 3,
			'notnull' => true,
		));
		$this->hasColumn('type', 'enum', null, array(
			'type' => 'enum',
			'values' =>
			array(
			0 => '0', 1 => '1', 2 => '2'
			),
			'notnull' => true,
		));


		$this->index('is_active_idx', array(
			'fields' =>
			array(
				0 => 'is_active',
			),
		));
	}

	public function setUp()
	{
		parent::setUp();

		$this->hasOne('UserRememberKey as RememberKey', array(
			'local' => 'id',
			'foreign' => 'user_id'));

		$this->hasOne('UserForgotPassword as ForgotPassword', array(
			'local' => 'id',
			'foreign' => 'user_id'));


		$timestampable0 = new Doctrine_Template_Timestampable(array(
			'updated' => array(
			'disabled' => true
		)));
		$this->actAs($timestampable0);
	}
}