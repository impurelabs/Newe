<?php
class pluginPagesComponents extends sfComponents
{
	public function executeMenu()
	{
		$this->pages = Doctrine_Core::getTable('Plugin_Pages_Page')->getForMenu($this->plugin->getId());
	}
}