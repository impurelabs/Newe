<?php

/**
 * ProfileCompanyTable
 */
class ProfileCompanyTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return ProfileCompanyTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ProfileCompany');
    }
}