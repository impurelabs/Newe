<?php

class profileConfiguration extends sfApplicationConfiguration
{
	public function configure()
	{
	}

	public function setup()
	{
		$this->setWebDir($this->getRootDir().'/../webProfile');

		return parent::setup();
	}
}
