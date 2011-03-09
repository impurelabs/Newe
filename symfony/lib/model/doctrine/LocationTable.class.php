<?php

/**
 * LocationTable
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class LocationTable extends Doctrine_Table
{
	static public function getInstance()
	{
		return Doctrine_Core::getTable('Location');
	}
}
