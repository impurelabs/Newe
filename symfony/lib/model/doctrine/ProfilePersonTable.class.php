<?php

/**
 * ProfilePersonTable
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class ProfilePersonTable extends Doctrine_Table
{
	static public function getInstance()
	{
		return Doctrine_Core::getTable('ProfilePerson');
	}
}
