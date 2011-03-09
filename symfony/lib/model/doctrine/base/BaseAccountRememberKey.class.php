<?php

/**
 * BaseAccountRememberKey
 * 
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
abstract class BaseAccountRememberKey extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('account_remember_key');
		$this->hasColumn('account_id', 'integer', 4, array(
			'type' => 'integer',
			'notnull' => true,
			'length' => '4',
			'unsigned' => true,
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