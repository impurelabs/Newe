<?php
/*emoarranged*/
/** 
 * pluginPages actions. -arranged
 *
 * @package    Emoapp
 * @subpackage pluginPages
 * @author     Iulian Manea <iulianwashere@gmail.com>
 * @versionSVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pluginPagesActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		 
		if ($this->page = Doctrine_Core::getTable('Plugin_Pages_Page')->getFirstPage($this->plugin->getId())){
			$this->setTemplate('index');
		} else {
			$this->setTemplate('noPage');
		}
	}

	public function executePage(sfWebRequest $request)
	{ 
		$this->forward404If(false == $this->page = Doctrine_Core::getTable('Plugin_Pages_Page')->getBySlugAndPluginAndMicrosite(
			$request->getParameter('slug'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		$this->updatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->page->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		);
	}

	public function executeAdd(sfWebRequest $request)
	{
		// Adding to the view the Plugin, for the menu
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		if (false == $this->updatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->plugin->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		};

		$this->form = new Plugin_Pages_PageForm();
		$this->form->setDefault('plugin_id', $this->plugin->getId());
		 
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid()){
				$this->form->save();
				$this->redirect(array(
					'sf_route' => 'plugin_pages_page',
					'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
					'plugin_slug' => $this->plugin->getSlug(),
					'slug' => $this->form->getObject()->getSlug()
				));
			}
		}
	}

	public function executeEdit(sfWebRequest $request)
	{
		// Adding to the view the Plugin, for the menu
		$this->forward404If(false == $this->page = Doctrine_Core::getTable('Plugin_Pages_Page')->getBySlugAndPluginAndMicrosite(
			$request->getParameter('slug'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		if (false == $this->updatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->page->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		};
		 
		$this->form = new Plugin_Pages_PageForm($this->page);

		/* Set the positions, if the case requires it (has more then one page) */
		$finalPosition = $this->page->getFinalPosition();
		$this->positions = array();
		for ($i = 1; $i <= $finalPosition; $i++){
			$this->positions[$i] = $i;
		}
		
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();
				
				/* Changing the position */
				$this->form->getObject()->moveToPosition((int)$request->getParameter('position'));
				return $this->renderText(json_encode(array('status' => true)));
			}
			return $this->renderPartial('formErrors', array('form' => $this->form));
		}
	}

	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404If(false == $page = Doctrine_Core::getTable('Plugin_Pages_Page')->findOneById($request->getParameter('page_id')));
		
		if (false == $this->updatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$page->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		};
		
		$page->delete();
		 
		return sfView::NONE;
	}

	public function executeSort(sfWebRequest $request)
	{
		if ($request->isMethod('post')){
			$plugin = Doctrine_Core::getTable('Plugin_Pages_Page')
				->findOneById($request->getParameter('page_id'))
				->moveToPosition(intval($request->getParameter('page_position')));
		}

		return $this->renderText('');
	}
}
