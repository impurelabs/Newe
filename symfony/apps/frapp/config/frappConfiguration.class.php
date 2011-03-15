<?php

class frappConfiguration extends sfApplicationConfiguration
{
	public function configure()
	{
		$this->dispatcher->connect('template.filter_parameters', array($this, 'frappViewLoader'));
	}

	/**
	 * Adds the layout details (details about the frapp which should be available in all the views) to all the views
	 *
	 * @param sfEvent $event
	 * @param <type> $parameters
	 * @return <type>
	 */
	public function frappViewLoader(sfEvent $event, $parameters)
	{
		if (sfContext::getInstance()->has('thisFrapp')){
			$parameters['thisFrapp'] = sfContext::getInstance()->get('thisFrapp')->getLayoutDetails();
		}

		// Return the new built $parameters
		return $parameters;
	}

	public function setup()
	{
		$this->setWebDir($this->getRootDir().'/../webFrapp');

		return parent::setup();
	}
}