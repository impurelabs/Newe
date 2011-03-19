<?php

/**
 * FrappSkinTable
 */
class FrappSkinTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return FrappSkinTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('FrappSkin');
    }
}