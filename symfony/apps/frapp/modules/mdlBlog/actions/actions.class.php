<?php
/**
 * mdlBlog actions.
 *
 * @package newe
 * @subpackage mdlBlog
 * @category FrappApp
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class mdlBlogActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		$this->posts = Doctrine_Core::getTable('Plugin_Blog_Post')->getAllForView($this->plugin->getId());
		$this->pluginUpdatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->plugin->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		);
	}

	public function executeView(sfWebRequest $request)
	{
		$this->forward404If(false == $this->post = Doctrine_Core::getTable('Plugin_Blog_Post')->getPublicByIdAndPluginAndMicrosite(
			$request->getParameter('id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		$this->updatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->post->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		);
		
		$this->permSocial = stPeterAcl::getInstance()->isAllowed($this->getUser()->getRoleId(), $this->post->getResourceId(), stPeterAcl::PERM_SOCIAL);
		$this->permSocialTrusted = stPeterAcl::getInstance()->isAllowed($this->getUser()->getRoleId(), $this->post->getResourceId(), stPeterAcl::PERM_SOCIAL_TRUSTED);
		 
	}

	public function executePreview(sfWebRequest $request)
	{
		$this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite($request->getParameter('plugin_slug'), $this->getContext()->get('thisMicrosite')->getId());

		$form = new Plugin_Blog_PostForm();

		$this->post = $request->getParameter($form->getName());
	}

	public function executeAdd(sfWebRequest $request)
	{
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		// Check permission
		if (!stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->plugin->getResourceId(), 
			stPeterAcl::PERM_CREATE)
		){
			throw new stPeter403Exception();
		}
		 
		$this->form = new Plugin_Blog_PostForm();
		$this->form->setDefault('plugin_id', $this->plugin->getId());
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if($this->form->isValid()){
				$this->form->save();
					
				if ($this->form->getObject()->getIsPublic()){
					// Published the post - log the activity
					// Log the activity
					Herodot::logActivity(array(
						'type' => Herodot::ACTIVITY_PLUGINBLOG_POST,
						'member_id'=> $this->getUser()->getMemberId(),
						'owner_id' => $this->getContext()->get('thisMicrosite')->getMemberId(),
						'microsite_id' => $this->getContext()->get('thisMicrosite')->getId(),
						'model_id' => $this->form->getObject()->getId(),
						'variables'=> array(
							'member_display_name' => $this->getUser()->getDisplayName(),
							'member_microsite_slug' => $this->getUser()->getMicrositeSlug(),
							'member_logo_sourceimage' => $this->getUser()->getLogoSourceimage(),
							'post_name' => $this->form->getObject()->getName(),
							'post_url'=> $this->getController()->genUrl(array(
								'sf_route' => 'plugin_blog_view',
								'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
								'plugin_slug'=> $this->form->getObject()->getPlugin()->getSlug(),
								'id' => $this->form->getObject()->getId(),
								'slug' => $this->form->getObject()->getSlug()
							)),
							'plugin_name' => $this->form->getObject()->getPlugin()->getName(),
							'plugin_url'=> $this->getController()->genUrl(array(
								'sf_route' => 'plugin_blog_index',
								'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
								'plugin_slug'=> $this->form->getObject()->getPlugin()->getSlug()
							))
						)
					));

					$this->redirect($this->getController()->genUrl(array(
						'sf_route' => 'plugin_blog_view',
						'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
						'plugin_slug'=> $this->plugin->getSlug(),
						'id' => $this->form->getObject()->getId(),
						'slug' => $this->form->getObject()->getSlug()
					)));
				} else {
					// Drafted the post
					$this->redirect($this->getController()->genUrl(array(
						'sf_route' => 'plugin_blog_edit',
						'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
						'plugin_slug'=> $this->plugin->getSlug(),
						'id' => $this->form->getObject()->getId()
					)));
				}
			}
		}
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404If(false == $this->post = Doctrine_Core::getTable('Plugin_Blog_Post')->getByIdAndPluginAndMicrosite(
			$request->getParameter('id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		/* Do security check */
		if (false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->post->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}

		$this->form = new Plugin_Blog_PostForm($this->post);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if($this->form->isValid()){
				$this->form->save();
				return $this->renderText(json_encode(array('status' => true)));
			} else {
				// Create the errors JSON response
				$errors = array();
				foreach($this->form->getErrorSchema()->getErrors() as $key => $error){
					$errors[$key] = $error->getMessage();
				}
				
				return $this->renderText(json_encode(array('status' => 'false', 'errors' => $errors)));
			}

		}
	}

	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404If(false === $post = Doctrine_Core::getTable('Plugin_Blog_Post')->getByIdAndPluginAndMicrosite(
				$request->getParameter('id'), 
				$request->getParameter('plugin_slug'), 
				$this->getContext()->get('thisMicrosite')->getId()
		));
		
		/*Security check*/
		if (false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$post->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}
		
		$post->delete();
		
		return $this->renderText(json_encode(array('status' => true)));
	}

	public function executePublish(sfWebRequest $request)
	{
		$this->forward404If(
			$request->isMethod('post') ||
			false == $this->post = Doctrine_Core::getTable('Plugin_Blog_Post')->getByIdAndPluginAndMicrosite(
			$request->getParameter('id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));

		$this->form = new Plugin_Blog_PostForm($this->post);
		$this->form->bind($request->getParameter($this->form->getName()));

		if($this->form->isValid()){
			$this->form->save();

			// Log the activity
			Herodot::logActivity(array(
				'type' => Herodot::ACTIVITY_PLUGINBLOG_POST,
				'member_id'=> $this->getUser()->getMemberId(),
				'owner_id' => $this->getContext()->get('thisMicrosite')->getMemberId(),
				'microsite_id' => $this->getContext()->get('thisMicrosite')->getId(),
				'model_id' => $this->form->getObject()->getId(),
				'variables'=> array(
					'member_display_name' => $this->getUser()->getDisplayName(),
					'member_microsite_slug' => $this->getUser()->getMicrositeSlug(),
					'member_logo_sourceimage' => $this->getUser()->getLogoSourceimage(),
					'post_name' => $this->form->getObject()->getName(),
					'post_url'=> $this->getController()->genUrl(array(
						'sf_route' => 'plugin_blog_view', 
						'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
						'plugin_slug'=> $this->form->getObject()->getPlugin()->getSlug(),
						'id' => $this->form->getObject()->getId(),
						'slug' => $this->form->getObject()->getSlug()
					)),
					'plugin_name' => $this->form->getObject()->getPlugin()->getName(),
					'plugin_url'=> $this->getController()->genUrl(array(
						'sf_route' => 'plugin_blog_index',
						'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
						'plugin_slug'=> $this->form->getObject()->getPlugin()->getSlug()
					))
				)
			));

			return $this->renderText(json_encode(array('status' => true)));
		}

		// Create the errors JSON response
		$errors = array();
		foreach($this->form->getErrorSchema()->getErrors() as $key => $error){
			$errors[$key] = $error->getMessage();
		}
		return $this->renderText(json_encode(array('status' => 'false', 'errors' => $errors)));
	}
}