<?php

/**
 * FrappMdlTable
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class FrappMdlTable extends Doctrine_Table
{
	static public function getInstance()
	{
		return Doctrine_Core::getTable('FrappMdl');
	}
}
