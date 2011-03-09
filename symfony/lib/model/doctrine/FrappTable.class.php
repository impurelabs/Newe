<?php

/**
 * FrappTable
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class FrappTable extends Doctrine_Table
{
	static public function getInstance()
	{
		return Doctrine_Core::getTable('Frapp');
	}
}
