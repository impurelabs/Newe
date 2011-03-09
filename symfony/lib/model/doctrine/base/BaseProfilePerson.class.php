<?php

/**
 * BaseProfilePerson
 *
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
abstract class BaseProfilePerson extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('profile_person');
		$this->hasColumn('account_id', 'integer', 4, array(
			'type' => 'integer',
			'primary' => true,
			'unsigned' => true,
			'length' => '4',
		));
		$this->hasColumn('first_name', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
		));
		$this->hasColumn('last_name', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
		));
		$this->hasColumn('slogan', 'string', 250, array(
			'type' => 'string',
			'length' => '250',
		));
		$this->hasColumn('date_of_birth', 'date', null, array(
			'type' => 'date',
		));
		$this->hasColumn('gender', 'enum', null, array(
			'type' => 'enum',
			'values' =>
			array(
			0 => '0', 1 => '1'
			),
		));
		$this->hasColumn('location_id', 'integer', 4, array(
			'type' => 'integer',
			'length' => '4',
			'unsigned' => true,
		));

		$this->option('symfony', array(
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
			'onDelete' => 'CASCADE'));

		$this->hasOne('Location', array(
			'local' => 'location_id',
			'foreign' => 'id'));
	}
}