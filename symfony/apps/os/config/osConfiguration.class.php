<?php

class osConfiguration extends sfApplicationConfiguration
{
	public function configure()
	{
	}

	public function setup()
	{
		$this->setWebDir($this->getRootDir().'/../webOs');

		return parent::setup();
	}
}
