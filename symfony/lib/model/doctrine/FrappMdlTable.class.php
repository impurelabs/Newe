<?php

/**
 * FrappMdlTable
 */
class FrappMdlTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return FrappMdlTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('FrappMdl');
    }

	public function getPositionedByFrapp($frappId = null)
	{
		if (!isset($frappId)){
			throw new sfException('Unset $frappId parameter in FrappMdlTable class.');
		}

		return Doctrine_Query::create()
			->from('FrappMdl m')
			->where('m.frapp_id = ?', $frappId)
			->orderBy('m.position ASC')
			->execute();
	}
}