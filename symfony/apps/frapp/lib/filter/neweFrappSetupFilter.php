<?php
class neweFrappSetupFilter extends sfFilter
{
	/**
	 * Executes this filter.
	 *
	 * @param sfFilterChain $filterChain A sfFilterChain instance
	 */
	public function execute($filterChain)
	{
		/* Try to load the Frapp, based on the slug from the URL. If not found throuw exception and redirect to Frapp Not Found page.  */
		if (false === $frapp = FrappTable::getInstance()->getForSetupFilter(sfContext::getInstance()->getRequest()->getUrlParameter('frapp_slug'))){
			throw new neweFrappNotFoundException();
		}
		
		// If we are in the error404 module/action just ignore
		if (sfConfig::get('sf_error_404_module') == $this->context->getModuleName() && sfConfig::get('sf_error_404_action') == $this->context->getActionName()){
			$filterChain->execute();
			return;
		}
		
		/* If the frapp has the state pending and the user is not the owner then throw 404 */
		if ($frapp->getState() == Microsite::STATE_PENDING && $frapp->getCreatorId() != sfContext::getInstance()->getUser()->getAccountId()){
			throw  new sfError404Exception();
		}
		
		/* If the frapp has the state destroyed throw a 404 */
		if ($frapp->getState() == Microsite::STATE_DESTROYED){
			throw  new sfError404Exception();
		}
		
		// add current frapp to context
		sfContext::getInstance()->set('thisFrapp', $frapp);

		// Set the current skin for the microsite
		sfConfig::set('app_skin_id', $frapp->getSkinId());
		
		// Continue the filter chain
		$filterChain->execute();
	}
}