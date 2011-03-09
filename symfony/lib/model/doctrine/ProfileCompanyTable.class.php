<?php

/**
 * ProfileCompanyTable
 *
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class ProfileCompanyTable extends Doctrine_Table
{
	static public function getInstance()
	{
		return Doctrine_Core::getTable('ProfileCompany');
	}
}
