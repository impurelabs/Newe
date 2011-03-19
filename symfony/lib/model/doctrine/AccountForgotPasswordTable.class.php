<?php

/**
 * AccountForgotPasswordTable
 */
class AccountForgotPasswordTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return AccountForgotPasswordTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AccountForgotPassword');
    }
}