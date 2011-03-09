<?php

/**
 * BaseAccountForgotPassword
 * 
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com
 */
abstract class BaseAccountForgotPassword extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('account_forgot_password');
		$this->hasColumn('account_id', 'integer', 4, array(
			'type' => 'integer',
			'notnull' => true,
			'unsigned' => true,
			'length' => '4',
		));
		$this->hasColumn('unique_key', 'string', 255, array(
			'type' => 'string',
			'primary' => true,
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
		$this->option('collate', 'utf8_unicode_ci');
		$this->option('charset', 'utf8');
	}

	public function setUp()
	{
		parent::setUp();
		$this->hasOne('Account', array(
			'local' => 'account_id',
			'foreign' => 'id',
			'onDelete' => 'CASCADE'
		));

		$timestampable0 = new Doctrine_Template_Timestampable(array());
		$this->actAs($timestampable0);
	}
}