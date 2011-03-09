<?php

/**
 * ProfileOrganizationTable
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class ProfileOrganizationTable extends Doctrine_Table
{
	static public function getInstance()
	{
		return Doctrine_Core::getTable('ProfileOrganization');
	}
}
