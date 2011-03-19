<?php
/*emoarranged*/
/**
 * pluginPhotos actions.
 *
 * @package    Emoapp
 * @subpackage pluginPhotos
 * @author     Iulian Manea <iulianwashere@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pluginPhotosActions extends sfActions
{

	public function executeIndex(sfWebRequest $request)
	{
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'),
			$this->getContext()->get('thisMicrosite')->getId()
		));

		// Check the permission for this plugin
		$this->pluginUpdatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->plugin->getResourceId(), 
			stPeterAcl::PERM_UPDATE
		);
		$this->albums = Doctrine_Core::getTable('Plugin_Photos_Album')->getAllForView($this->plugin->getId());
	}

	public function executeAlbumAdd(sfWebRequest $request)
	{
		$this->forward404If(false == $this->plugin = Doctrine_Core::getTable('Plugin')->getBySlugAndMicrosite(
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		 
		// Check for permissions
		if (false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(),
			$this->plugin->getResourceId(),
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();
		}
		 
		$this->form = new Plugin_Photos_AlbumForm();
		$this->form->setDefault('plugin_id', $this->plugin->getId());
		 
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if($this->form->isValid()){
				$this->form->save();
					
				$this->redirect($this->getController()->genUrl(array('sf_route' => 'plugin_photos_photo_list', 'album_id' => $this->form->getObject()->getId(), 'plugin_slug' => $this->plugin->getSlug(), 'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug())));					
			}
		}
	}

	public function executeAlbumEdit(sfWebRequest $request)
	{
		$this->forward404If(false == $this->album = Doctrine_Core::getTable('Plugin_Photos_Album')->getIdAndPluginAndMicrosite(
			$request->getParameter('album_id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		 
		// Check for permissions
		if (false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(),
			$this->album->getResourceId(),
			stPeterAcl::PERM_UPDATE
		)){
			throw new stPeter403Exception();		
		};
		 
		$this->form = new Plugin_Photos_AlbumForm($this->album);
		 
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();
					
				$this->redirect($this->getController()->genUrl(array(
					'sf_route' => 'plugin_photos_photo_list',
					'album_id' => $this->form->getObject()->getId(), 
					'plugin_slug' => $this->form->getObject()->getPlugin()->getSlug(),
					'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug())));
			}
		}
	}

	public function executeAlbumDelete(sfWebRequest $request)
	{
		$this->forward404If(false == $album = Doctrine_Core::getTable('Plugin_Photos_Album')->getIdAndPluginAndMicrosite(
			$request->getParameter('album_id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		 
		// Check for permissions
		if (false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$album->getResourceId(), 
			stPeterAcl::PERM_DELETE)
		){
			throw new stPeter403Exception();
		}
		 
		$album->delete();
		
		return $this->renderText(json_encode(array('status' => true)));
	}

	public function executePhotoList(sfWebRequest $request)
	{
		$this->forward404If(false == $this->album = Doctrine_Core::getTable('Plugin_Photos_Album')->getIdAndPluginAndMicrosite(
			$request->getParameter('album_id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));

		$this->pluginUpdatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->album->getResourceId(), 
			stPeterAcl::PERM_UPDATE);
		$this->photos = Doctrine_Core::getTable('Plugin_Photos_Photo')->getListForView($this->album->getId());
		
		$this->addPhotosUrl = $this->generateUrl('plugin_photos_photo_add', array(
			'album_id' => $this->album->getId(), 
			'plugin_slug' => $this->album->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		$this->albumEditUrl = $this->generateUrl('plugin_photos_album_edit', array(
			'album_id' => $this->album->getId(), 
			'plugin_slug' => $this->album->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		$this->albumListUrl = $this->generateUrl('plugin_photos_index', array(
			'plugin_slug' => $this->album->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		$this->albumDeleteUrl = $this->generateUrl('plugin_photos_album_delete', array(
			'album_id' => $this->album->getId(), 
			'plugin_slug' => $this->album->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		$this->sortUrl = $this->generateUrl('plugin_photos_photo_sort', array(
			'album_id' => $this->album->getId(), 
			'plugin_slug' => $this->album->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		$this->photoDeleteUrl = $this->generateUrl('plugin_photos_photo_delete', array(
			'album_id' => $this->album->getId(), 
			'plugin_slug' => $this->album->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		
	}

	public function executePhotoAdd(sfWebRequest $request)
	{
		$this->forward404If(false == $this->album = Doctrine_Core::getTable('Plugin_Photos_Album')->getIdAndPluginAndMicrosite(
			$request->getParameter('album_id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		 
		// Check for permissions
		if(false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(),
			$this->album->getResourceId(),
			stPeterAcl::PERM_CREATE
		)){
			throw new stPeter403Exception();
		};
		 
		if ($request->isMethod('post')){
			$photoCounter = count($request->getParameter('description'));
			$photosForLog = array();
			$i = 1;

			foreach($request->getParameter('description') as $photoId => $description){
				$photo = Doctrine_Core::getTable('Plugin_Photos_Photo')->findOneById($photoId);
				$photo->setDescription($description);
				$photo->save();		
			}

			$this->redirect($this->getController()->genUrl(array(
				'sf_route' => 'plugin_photos_photo_list', 
				'album_id' => $this->album->getId(), 
				'plugin_slug' => $this->album->getPlugin()->getSlug(), 
				'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()
			)));
		}
		 


		$this->form = new PluginPhotosUploadForm();
		$this->form->setDefault('plugin_photos_album_id', $this->album->getId());
	}

	public function executePhotoAddSimple(sfWebRequest $request)
	{
		$this->form = new PluginPhotosUploadForm();
		$this->form->setDefault('plugin_photos_album_id', '7');
	}

	public function executePhotoAddFinish(sfWebRequest $request)
	{
		$this->addedPhotos = Doctrine_Core::getTable('Plugin_Photos_Photo')->getByIds($request->getParameter('addedIds'));
	}

	public function executePhotoUpload(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod('post'));
		 
		$this->form = new PluginPhotosUploadForm();

		if (isset($_FILES['file'])){
			$_FILES['plugin_photos_photo'] = array(
				'name' => array('file' => $_FILES['file']['name']),
				'type' => array('file' => $_FILES['file']['type']),
				'tmp_name' => array('file' => $_FILES['file']['tmp_name']),
				'error' => array('file' => $_FILES['file']['error']),
				'size' => array('file' => $_FILES['file']['size'])
			);
			unset($_FILES['file']);
		}

		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		
		if($this->form->isValid()){
			$this->form->save();
      
			$this->getContext()->getConfiguration()->loadHelpers('Emo');
			
			// Log the activity
			Herodot::logActivity(array(
				'type'         => Herodot::ACTIVITY_PLUGINPHOTOS_UPLOAD,
				'member_id'    => $this->getUser()->getMemberId(),
				'owner_id'     => $this->getContext()->get('thisMicrosite')->getMemberId(),
				'microsite_id' => $this->getContext()->get('thisMicrosite')->getId(),
				'model_id'     => $this->form->getObject()->getId(),
				'variables'    => array(
					'member_display_name' => $this->getUser()->getDisplayName(),
					'member_microsite_slug'   => $this->getUser()->getMicrositeSlug(),
					'member_logo_sourceimage' => $this->getUser()->getLogoSourceimage(),
					'album_name' => $this->form->getObject()->getPlugin_Photos_Album()->getName(),
					'album_url'  => $this->getController()->genUrl(array(
						'sf_route'       => 'plugin_photos_photo_list', 
						'album_id'     => $this->form->getObject()->getPlugin_Photos_Album()->getId(), 
						'plugin_slug'    => $this->form->getObject()->getPlugin_Photos_Album()->getPlugin()->getSlug(), 
						'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug())),
						'photo_filename' => $this->form->getObject()->getFilename(),
						'photo_url'      => $this->getController()->genUrl(array(
							'sf_route'       => 'plugin_photos_photo_view',
							'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
							'album_id'       => $this->form->getObject()->getPlugin_Photos_Album()->getId(),
							'plugin_slug'    => $this->form->getObject()->getPlugin_Photos_Album()->getPlugin()->getSlug(),
							'photo_id'       => $this->form->getObject()->getId()
						)
					)
				)
			));
			
			
			die(json_encode(array(
				'isOk' => true, 
				'id' => $this->form->getObject()->getId(),
				'src' => emoPluginPhotosPhotoThumb($this->form->getObject()->getFilename())
			)));
		}
		 
	}

	public function executePhotoView(sfWebRequest $request)
	{
		$this->forward404If(false == $this->photo = Doctrine_Core::getTable('Plugin_Photos_Photo')->getByIdAndAlbumAndPluginAndMicrosite(
				$request->getParameter('photo_id'), 
				$request->getParameter('album_id'), 
				$request->getParameter('plugin_slug'), 
				$this->getContext()->get('thisMicrosite')->getId()
		));
		
		$this->pluginUpdatePermission = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->photo->getPlugin_Photos_Album()->getResourceId(), 
			stPeterAcl::PERM_UPDATE);
		$this->photoCount = $this->photo->getPlugin_Photos_Album()->getPhotoCount();
		$this->neighbours = Doctrine_Core::getTable('Plugin_Photos_Photo')->getNeighbours($this->photo->getPluginPhotosAlbumId(), $this->photo->getPosition());
		$this->permSocial = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->photo->getResourceId(), 
			stPeterAcl::PERM_SOCIAL);
		$this->permSocialTrusted = stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(), 
			$this->photo->getResourceId(), 
			stPeterAcl::PERM_SOCIAL_TRUSTED);

		$this->photoEditUrl = $this->generateUrl('plugin_photos_photo_edit', array(
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
			'album_id'       => $this->photo->getPlugin_Photos_Album()->getId(),
			'plugin_slug'    => $this->photo->getPlugin_Photos_Album()->getPlugin()->getSlug(),
			'photo_id'       => $this->photo->getId()
		));
		
		if (isset($this->neighbours['previous'])){
			$this->previousUrl = $this->generateUrl('plugin_photos_photo_view', array(
				'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(), 
				'album_id' => $this->photo->getPlugin_Photos_Album()->getId(), 
				'plugin_slug' => $this->photo->getPlugin_Photos_Album()->getPlugin()->getSlug(), 
				'photo_id' => $this->neighbours['previous']['id']));
		}
		if (isset($this->neighbours['next'])){
			$this->nextUrl = $this->generateUrl('plugin_photos_photo_view', array(
				'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(), 
				'album_id'       => $this->photo->getPlugin_Photos_Album()->getId(), 
				'plugin_slug'    => $this->photo->getPlugin_Photos_Album()->getPlugin()->getSlug(), 
				'photo_id'       => $this->neighbours['next']['id']));
		}
		$this->pluginUrl = $this->generateUrl('plugin_photos_index', array(
			'plugin_slug' => $this->photo->getPlugin_Photos_Album()->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		$this->albumUrl = $this->generateUrl('plugin_photos_photo_list', array(
			'album_id' => $this->photo->getPlugin_Photos_Album()->getId(), 
			'plugin_slug' => $this->photo->getPlugin_Photos_Album()->getPlugin()->getSlug(), 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug()));
		$this->photoUrl = $this->generateUrl('plugin_photos_photo_view', array( 
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(), 
			'album_id' => $this->photo->getPlugin_Photos_Album()->getId(), 
			'plugin_slug' => $this->photo->getPlugin_Photos_Album()->getPlugin()->getSlug(), 
			'photo_id' => $this->photo->getId()));
		$this->commentDeleteUrl = $this->generateUrl('comment_delete', array('action' => 'pluginPhotosPhoto'));
	}

	public function executePhotoCommentAdd(sfWebRequest $request)
	{
		$this->forward404Unless($request->isXmlHttpRequest() and $request->isMethod('post'));
		 
		$this->photo = Doctrine_Core::getTable('Plugin_Photos_Photo')
			->getIdAndPluginAndMicrosite($request->getParameter('photo_id'), $request->getParameter('album_id'), $request->getParameter('plugin_slug'), $this->getContext()->get('thisMicrosite')->getId());
		 
		$form = new Plugin_Photos_PhotoCommentForm();
		$form->setDefault('plugin_photos_photo_id', $photo->getId());
		$form->setDefault('member_id', $this->getUser()->getMemberId());

		$form->bind($request->getParameter($form->getName()));

		if($form->isValid()){
			$form->save();
			return $this->renderText(json_encode(array('status' => true)));
		}
		 
		return $this->renderText(json_encode(array('status' => false)));
	}

	public function executePhotoSort(sfWebRequest $request)
	{
		$this->forward404If(false == $photo = Doctrine_Core::getTable('Plugin_Photos_Photo')->findOneById($request->getParameter('photo_id')));
		
		// Check for permissions
		if(false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(),
			$photo->getResourceId(),
			stPeterAcl::PERM_CREATE
		)){
			throw new stPeter403Exception();
		};    
			
		$photo->moveToPosition(intval($request->getParameter('photo_position')));

		return $this->renderText(json_encode(array('status' => true)));
	}
	
	public function executePhotoDelete(sfWebRequest $request)
	{
		$this->forward404If(false == $photo = Doctrine_Core::getTable('Plugin_Photos_Photo')->findOneById($request->getParameter('photo_id')));
		
		// Check for permissions
		if(false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(),
			$photo->getResourceId(),
			stPeterAcl::PERM_CREATE
		)){
			throw new stPeter403Exception();
		};    
			
		$photo->delete();

		return $this->renderText(json_encode(array('status' => true)));
	}

	public function executePhotoEdit(sfWebRequest $request)
	{
		if ($request->isXmlHttpRequest()){
			$this->setLayout(false);
		}
		
		$this->forward404If(false == $this->photo = Doctrine_Core::getTable('Plugin_Photos_Photo')->getByIdAndAlbumAndPluginAndMicrosite(
			$request->getParameter('photo_id'), 
			$request->getParameter('album_id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		// Check for permissions
		if(false == stPeterAcl::getInstance()->isAllowed(
			$this->getUser()->getRoleId(),
			$this->photo->getResourceId(),
			stPeterAcl::PERM_CREATE
		)){
			throw new stPeter403Exception();
		}; 

		$this->form = new PluginPhotosPhotoDescriptionEditForm($this->photo);
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				return $this->renderText(json_encode(array('status' => true, 'htmlContent' => $this->photo->getDescription())));
			}
		}
		
		$this->photoEditUrl = $this->generateUrl('plugin_photos_photo_edit', array(
			'microsite_slug' => $this->getContext()->get('thisMicrosite')->getSlug(),
			'album_id'       => $this->photo->getPlugin_Photos_Album()->getId(),
			'plugin_slug'    => $this->photo->getPlugin_Photos_Album()->getPlugin()->getSlug(),
			'photo_id'       => $this->photo->getId()));
	}

	public function executePhotoDescription(sfWebRequest $request)
	{
		if ($request->isXmlHttpRequest()){
			$this->setLayout(false);
		}

		$this->forward404If(false == $photo = Doctrine_Core::getTable('Plugin_Photos_Photo')->getIdAndPluginAndMicrosite(
			$request->getParameter('photo_id'), 
			$request->getParameter('album_id'), 
			$request->getParameter('plugin_slug'), 
			$this->getContext()->get('thisMicrosite')->getId()
		));
		
		return $this->renderPartial('pluginPhotos/photoDescription', array('photo' => $photo));
	}

}