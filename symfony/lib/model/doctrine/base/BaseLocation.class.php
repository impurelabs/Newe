<?php

/**
 * BaseLocation
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
abstract class BaseLocation extends sfDoctrineRecord
{
	public function  setTableDefinition()
	{
		$this->setTableName('location');

		$this->hasColumn('id', 'integer', 4, array(
			'type' => 'integer',
			'primary' => true,
			'unsigned' => true,
			'autoincrement' => true,
			'primary' => true,
			'length' => 4
		));
		$this->hasColumn('city', 'string', 100, array(
			'type' => 'string',
			'notnull' => true,
			'length' => 100
		));
		$this->hasColumn('region', 'string', 100, array(
			'type' => 'string',
			'notnull' => true,
			'length' => 100
		));
		$this->hasColumn('country', 'string', 2, array(
			'type' => 'string',
			'notnull' => true,
			'length' => 2
		));
		$this->hasColumn('lang', 'string', 2, array(
			'type' => 'string',
			'notnull' => true,
			'length' => 2
		));
		$this->hasColumn('population', 'integer', 3, array(
			'type' => 'integer',
			'unsigned' => true,
			'notnull' => true,
			'default' => '0',
			'length' => 3
		));

		$this->option('collate', 'utf8_unicode_ci');
		$this->option('charset', 'utf8');
		$this->index('city', array(
			'fields' => array('city')
		));
	}
}
?>
