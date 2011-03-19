<?php

/**
 * FrappTable
 */
class FrappTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return FrappTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Frapp');
    }

	/**
	 * Returns the Frapp object that will be put in the sfContext for the loaded frapp.
	 * The basic related objects are preloaded.
	 *
	 * @return Frapp
	 */
	public function getForSetupFilter($host = null)
	{
		if (!isset($host)){
			return false;
		}

		/* If the host is a subdomain of app_frapp_base_host we use only the subdomain */
		if (false !== strpos($host, sfConfig::get('app_frapp_base_host'))){
			$pices = explode('.', $host);
			$slug = $pices[count($pices) - 3];
		} else {
			$slug = $host;
		}

		$frapp =  Doctrine_Query::create()
			->from('Frapp f')
			->where('f.slug = ?', $slug)
			->fetchOne();

		/* Load the installed modules */
		$frapp->setMdls(FrappMdlTable::getInstance()->getPositionedByFrapp($frapp->getId()));

		return $frapp;
	}
}