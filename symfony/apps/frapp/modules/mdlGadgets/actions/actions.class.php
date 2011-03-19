<?php
/*emoarranged*/
/**
 * home actions.
 *
 * @package    Emoapp
 * @subpackage home
 * @author     Iulian Manea <iulianwashere@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pluginGadgetsActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		// Set layout
		$this->setLayout('layoutGadgetable');
		
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));  
		
		$this->hasUpdatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->getContext()->get('thisMicrosite')->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		);
		
		// Set variables for the template
		$this->gadgets = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getWithParametersByPlugin($this->plugin->getId());
		$this->containerHeight = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getContainerHeight($this->gadgets);
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		)); 
		
		// Check permission
		/*if (!stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->plugin->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}*/
		
		// Set layout
		$this->setLayout('layoutGadgetable');
		
		$gadgets = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getWithParametersByPlugin($this->plugin->getId());
		
		// Set variables for the template
		$this->containerHeight = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getContainerHeight($gadgets);
		
		$this->gadgets = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->prepareForEdit($gadgets);
		
		$this->gridX = sfConfig::get('app_plugin_gadgets_grid_x');
		$this->gridY = sfConfig::get('app_plugin_gadgets_grid_y');
		$this->gadgetMinWidth = sfConfig::get('app_plugin_gadgets_gadget_min_width');
		$this->gadgetMinHeight = sfConfig::get('app_plugin_gadgets_gadget_min_height');
	}
	
	/**
	 * Returns the html for a certain gadget. The html is created by the gadget component.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeGetGadgetForEdit(sfWebRequest $request)
	{
  	// Check permission
    if (!stPeterAcl::getInstance()->isAllowed($this->getUser()->getRoleId(), $this->getContext()->get('thisMicrosite')->getResourceId(), stPeterAcl::PERM_READ)){
      throw new stPeter403Exception();                                            
    }
		
		$this->forward404Unless($request->isXmlHttpRequest());
		 
		$gadget = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->findOneById($request->getParameter('gadgetId'));

		$typeKey = ($request->getParameter('type_key') == 'info') ? 'info_' . $this->getContext()->get('thisMicrosite')->getType() :
		$request->getParameter('type_key');
		
		return $this->renderComponent('pluginGadgets', 'gadget' . ucfirst($typeKey) . 'ForEdit', array('parameters' => unserialize($gadget->getParameters())));
	}
	
	/**
	 *
	 * @param sfWebRequest $request
	 * @todo check the input variables. ex that the coords are corrent multiples etc
	 */
	public function executeAddGadget(sfWebRequest $request)
	{		 
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		)); 
		
		// Check permission
		if (!stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->plugin->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}
		
		if ($request->isMethod('post')){
			// Set the typeKey.
			$typeKey = $request->getParameter('type_key');
			
			$modelName = sfConfig::get('app_gadget_' . $typeKey . '_model');
			// Add the gadget
			$gadget = new Plugin_Gadgets_Gadget();
			$gadget->setPlugin($this->plugin);
			$gadget->setTypeKey($typeKey);
			$gadget->setParameters(Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getDefaultParameters($this->getContext()->get('thisMicrosite')->getId(), $typeKey));
			$gadget->setCoordX(sfConfig::get('app_plugin_gadgets_gadget_default_coord_x'));
			$gadget->setCoordY(Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getBottomCoord($this->plugin->getId()));
			$gadget->setSkin(sfConfig::get('app_gadget_' . $typeKey . '_default_skin'));
			$gadget->setWidth(sfConfig::get('app_gadget_' . $typeKey . '_default_width'));
			$gadget->setHeight(sfConfig::get('app_gadget_' . $typeKey . '_default_height'));
			$gadget->save();

			return $this->renderText($gadget->exportTo('json', false));
		}
		
		$this->typeKey =array(
			'activity' => sfConfig::get('app_gadget_activity_type_key'),
			'blog' => sfConfig::get('app_gadget_blog_type_key'),
			'content' => sfConfig::get('app_gadget_content_type_key'),
			'identity' => sfConfig::get('app_gadget_identity_type_key'),
			'photos' => sfConfig::get('app_gadget_photos_type_key'),
			'tags' => sfConfig::get('app_gadget_tags_type_key'),
		);
	}

	public function executeEditGadget(sfWebRequest $request)
	{
		$this->setLayout('layoutFull');
		
		$this->forward404If(false == $this->gadget = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getByIdAndPluginAndMicrosite(
			$request->getParameter('gid'),
			$request->getParameter('plugin_slug') ,
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
	// Check permission
		if (!stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->getContext()->get('thisMicrosite')->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}
		 
		$formClassName = 'Gadget' . ucfirst($this->gadget->getTypeKey()) . 'Form';
		 
		$values = unserialize($this->gadget->getParameters());
		 
		$this->form = new $formClassName($values, array('microsite_id' => $this->getContext()->get('thisMicrosite')->getId()));
		 
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$newValues = $this->form->getValues();
					
				$this->gadget->setParameters(serialize($newValues));
				$this->gadget->save();
				$this->redirect($this->getController()->genUrl(array(
					'sf_route' => 'plugin_gadgets_actions',
					'action' => 'index',
					'plugin_slug' => $this->gadget->getPlugin()->getSlug(),
					'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug())
				));
			}
		}

		$this->setTemplate('editGadget' . ucfirst($this->gadget->getTypeKey()));
	}

	public function executeEditGadgetPosition(sfWebRequest $request)
	{
		$this->forward404If(false == $gadget = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getByIdAndPluginAndMicrosite(
			$request->getParameter('gid'),
			$request->getParameter('plugin_slug') ,
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		// Check permission
		if (!stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->getContext()->get('thisMicrosite')->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}
		
		$gadget->setCoordX($request->getParameter('coord_x'));
		$gadget->setCoordY($request->getParameter('coord_y'));
		$gadget->save();
		
		return sfView::NONE;
	}

	public function executeEditGadgetSize(sfWebRequest $request)
	{
		$this->forward404If(false == $gadget = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getByIdAndPluginAndMicrosite(
			$request->getParameter('gid'),
			$request->getParameter('plugin_slug') ,
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		// Check permission
		if (!stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->getContext()->get('thisMicrosite')->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}
		
		$gadget->setWidth($request->getParameter('width'));
		$gadget->setHeight($request->getParameter('height'));
		$gadget->setCoordX($request->getParameter('coord_x'));
		$gadget->setCoordY($request->getParameter('coord_y'));
		$gadget->save();

		return sfView::NONE;
	}
	
	public function executeDeleteGadget(sfWebRequest $request)
	{
		$this->forward404If(
			!$request->isMethod('delete') || /* Only accept DELETE requests */
			false == $this->gadget = Doctrine_Core::getTable('Plugin_Gadgets_Gadget')->getByIdAndPluginAndMicrosite(
				$request->getParameter('gid'),
				$request->getParameter('plugin_slug') ,
				$this->getContext()->get('thisMicrosite')->getId()
			)
		);
		
	// Check permission
		if (!stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->getContext()->get('thisMicrosite')->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}
		
		
		// Delete the gadget
		$this->gadget->delete();
			
		return sfView::NONE;			
	}
}