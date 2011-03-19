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
		$frapp = sfContext::getInstance()->get('thisFrapp');

		// If we are in the error404 module/action just ignore
		if (sfConfig::get('sf_error_404_module') == $this->context->getModuleName() && sfConfig::get('sf_error_404_action') == $this->context->getActionName()){
			$filterChain->execute();
			return;
		}
		
		/* If the frapp has the state pending and the user is not the owner then throw 404 */
		if ($frapp->getState() == Frapp::STATE_PENDING && $frapp->getCreatorId() != sfContext::getInstance()->getUser()->getAccountId()){
			throw  new sfError404Exception();
		}
		
		/* If the frapp has the state destroyed throw a 404 */
		if ($frapp->getState() == Frapp::STATE_DESTROYED){
			throw  new sfError404Exception();
		}
		
		// Continue the filter chain
		$filterChain->execute();
	}
}