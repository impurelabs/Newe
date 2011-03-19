<?php

/**
 * LocationTable
 */
class LocationTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return LocationTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Location');
    }
}