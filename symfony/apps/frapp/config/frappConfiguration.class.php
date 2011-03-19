<?php

class frappConfiguration extends sfApplicationConfiguration
{
	public function configure()
	{
		$this->dispatcher->connect('request.filter_parameters', array($this, 'frappLoader'));
		$this->dispatcher->connect('routing.load_configuration', array($this, 'frappMdlRouteLoader'));
		$this->dispatcher->connect('template.filter_parameters', array($this, 'frappViewLoader'));
	}

	/**
	 * Gets the frapp slug from the URL, and based on it, loads the frapp in the sfContext. If the frapp slug doesn't match, it just throws a 404.
	 *
	 * @param sfEvent $event
	 * @param $parameters
	 * @throws neweFrappNotFoundException
	 */
	public function frappLoader(sfEvent $event, $parameters)
	{
		/* Try to load the Frapp, based on the slug from the URL. If not found throw neweFrappNotFoundException.  */
		if (false === $frapp = FrappTable::getInstance()->getForSetupFilter($event->getSubject()->getHost())){
			throw new neweFrappNotFoundException();
		}
		sfContext::getInstance()->set('thisFrapp', $frapp);

		return $parameters;
	}

	/**
	 * Loads the routes for the installed on the current frapp
	 *
	 * @param sfEvent $event
	 * @param $parameters
	 * @throws neweFrappNotFoundException
	 */
	public function frappMdlRouteLoader(sfEvent $event)
	{
		sfContext::getInstance()->get('thisFrapp')->loadMdlRoutes($event->getSubject());
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