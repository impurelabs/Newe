<?php

/**
 * ProfileOrganizationTable
 */
class ProfileOrganizationTable extends Doctrine_Table
{
	/**
	 * Returns an instance of this class.
	 *
	 * @return ProfileOrganizationTable
	 */
	public static function getInstance()
	{
		return Doctrine_Core::getTable('ProfileOrganization');
	}
}