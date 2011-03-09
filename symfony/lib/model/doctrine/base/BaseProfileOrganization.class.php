<?php

/**
 * BaseProfileOrganization
 * @package    newe
 * @subpackage model
 * @author     Iulian Manea <iulian.manea@impurelabs.com>
 */
abstract class BaseProfileOrganization extends sfDoctrineRecord
{
	public function setTableDefinition()
	{
		$this->setTableName('profile_organization');
		$this->hasColumn('account_id', 'integer', 4, array(
			'type' => 'integer',
			'primary' => true,
			'unsigned' => true,
			'length' => '4',
		));
		$this->hasColumn('name', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
		));
		$this->hasColumn('brand_name', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
		));
		$this->hasColumn('slogan', 'string', 250, array(
			'type' => 'string',
			'length' => '250',
		));
		$this->hasColumn('cui', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
		));
		$this->hasColumn('contact_name', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
		));
		$this->hasColumn('contact_job_title', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
		));
		$this->hasColumn('contact_email', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
			'email' => true
		));
		$this->hasColumn('contact_phone', 'string', 100, array(
			'type' => 'string',
			'length' => '100',
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