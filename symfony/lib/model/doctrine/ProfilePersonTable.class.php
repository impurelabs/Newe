<?php

/**
 * ProfilePersonTable
 */
class ProfilePersonTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return ProfilePersonTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ProfilePerson');
    }
}