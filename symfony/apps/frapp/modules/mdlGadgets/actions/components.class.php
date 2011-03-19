<?php
class pluginGadgetsComponents extends sfComponents
{
	public function executeGadgetContent()
	{
		$this->content = $this->parameters['content'];
	}
	
	public function executeGadgetContentForEdit()
	{
		$this->content = $this->parameters['content'];
	}

	public function executeGadgetPhotos()
	{
		$this->photos = Doctrine_Core::getTable('Plugin_Photos_Album')->getGadget($this->parameters['limit'], $this->parameters['plugins']);
	}

	public function executeGadgetPhotosForEdit()
	{
		$this->photos = Doctrine_Core::getTable('Plugin_Photos_Album')->getGadget($this->parameters['limit'], $this->parameters['plugins']);
	}

	public function executeGadgetBlog()
	{
		$this->posts = Doctrine_Core::getTable('Plugin_Blog_Post')->getGadget($this->parameters['limit'], $this->parameters['plugins']);
	}

	public function executeGadgetBlogForEdit()
	{
		$this->posts = Doctrine_Core::getTable('Plugin_Blog_Post')->getGadget($this->parameters['limit'], $this->parameters['plugins']);
	}

	public function executeGadgetActivity()
	{
		switch ($this->getContext()->get('thisMicrosite')->getType()){
			case Microsite::TYPE_PERSON:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForMemberMicrosite($this->parameters['limit'],
																																	$this->parameters['type_classes'],
																																	$this->getContext()->get('thisMicrosite')->getMemberId(),
																																	$this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_ORGANIZATION:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForMemberMicrosite($this->parameters['limit'],
																																	$this->parameters['type_classes'],
																																	$this->getContext()->get('thisMicrosite')->getMemberId(),
																																	$this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_COMPANY:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForMemberMicrosite($this->parameters['limit'],
																																	$this->parameters['type_classes'],
																																	$this->getContext()->get('thisMicrosite')->getMemberId(),
																																	$this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_CAUSE:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForCauseMicrosite($this->parameters['limit'],
																																 $this->parameters['type_classes'],
																																 $this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_CAMPAIGN:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForCampaignMicrosite($this->parameters['limit'],
																																		 $this->parameters['type_classes'],
																																		 $this->getContext()->get('thisMicrosite')->getId());
				break;
		}

	}

	public function executeGadgetActivityForEdit()
	{
		switch ($this->getContext()->get('thisMicrosite')->getType()){
			case Microsite::TYPE_PERSON:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForMemberMicrosite($this->parameters['limit'],
																																	$this->parameters['type_classes'],
																																	$this->getContext()->get('thisMicrosite')->getMemberId(),
																																	$this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_ORGANIZATION:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForMemberMicrosite($this->parameters['limit'],
																																	$this->parameters['type_classes'],
																																	$this->getContext()->get('thisMicrosite')->getMemberId(),
																																	$this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_COMPANY:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForMemberMicrosite($this->parameters['limit'],
																																	$this->parameters['type_classes'],
																																	$this->getContext()->get('thisMicrosite')->getMemberId(),
																																	$this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_CAUSE:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForCauseMicrosite($this->parameters['limit'],
																																 $this->parameters['type_classes'],
																																 $this->getContext()->get('thisMicrosite')->getId());
				break;
			case Microsite::TYPE_CAMPAIGN:
				$this->activities = Doctrine_Core::getTable('HerodotActivity')
																		->getGadgetForCampaignMicrosite($this->parameters['limit'],
																																		 $this->parameters['type_classes'],
																																		 $this->getContext()->get('thisMicrosite')->getId());
				break;
		}

	}

	public function executeGadgetTags()
	{
		$this->tags = $this->getContext()->get('thisMicrosite')->getRespTags($this->getUser()->getCulture());
	}
	
	public function executeGadgetTagsForEdit()
	{
		$this->tags = $this->getContext()->get('thisMicrosite')->getRespTags($this->getUser()->getCulture());
	}
	
	public function executeGadgetIdentity()
	{
	}
	
	public function executeGadgetIdentityForEdit()
	{
	}
}