<?php

/**
 * Returns the web path for the microsite logo sourceimage file
 * @param $sourceimage
 */
function emoLogoSourceimage($sourceimage)
{
	return sfConfig::get('app_logo_path_for_web') . '/' . $sourceimage;
}

/**
 * Returns the web path for the microsite logo file
 * @param $sourceimage
 */
function emoLogo($sourceimage)
{
	return sfConfig::get('app_logo_path_for_web') . '/logo-' . $sourceimage;
}

/**
 * Returns the web path for the microsite logo thumbnail T1 file
 * @param $sourceimage
 */
function emoLogoT1($sourceimage)
{
	return sfConfig::get('app_logo_path_for_web') . '/t1-' . $sourceimage;
}

/**
 * Returns the web path for the microsite logo thumbnail T2 file
 * @param $sourceimage
 */
function emoLogoT2($sourceimage)
{
	return sfConfig::get('app_logo_path_for_web') . '/t2-' . $sourceimage;
}

function emoStPeterAclPermission($role)
{
  if ($role == stPeterAcl::ROLE_ANONYMOUS){
    return 'anyone';
  }
  
  if ($role == stPeterAcl::ROLE_ANY_MEMBER){
    return 'all members';
  }
  
  if ($role == stPeterAcl::ROLE_NETWORK){
    return 'my network';
  }
  
  if ($role == stPeterAcl::ROLE_CONNECTION){
    return 'all connections';
  }
  
  if ($role == stPeterAcl::ROLE_TAGGED_CONNECTION){
    return 'tagged connections';
  }
  
  if ($role == stPeterAcl::ROLE_MEMBER){
    return 'just me';
  } 

  return false;
}

function emoConnectionTagDeleteError($places)
{
	$translator = sfContext::getInstance()->getI18N();
	
	$result = '<p class="error_list">' . $translator->__('Cannot delete this tag because it is used in the following places:') . '</p>';
	$result .= '<ul>';
	
	
	if (count($places['microsite_privacy']) > 0){
		foreach ($places['microsite_privacy'] as $place){
		  $result .= '<li> - <a href="' . sfContext::getInstance()->getController()->genUrl(array('sf_route' => 'microsite_settings', 'microsite_slug' => $place['slug'], 'action' => 'privacy')) . '" class="important-link">"' . $place['name'] . '" privacy</a></li>';	
		}
		 
	}
	
	$result .= '</ul>';
	
	return $result;
}
/**
 * Part of Plugin_Photos_Photo. Returns web path to photo file 
 * @param unknown_type $sourceimage
 */
function emoPluginPhotosPhoto($sourceimage)
{
	return sfConfig::get('app_plugin_photos_path_for_web') . '/' . $sourceimage;
}
/**
 * Part of Plugin_Photos_Photo. Returns web path to photo thumbnail file 
 * @param unknown_type $sourceimage
 */
function emoPluginPhotosPhotoThumb($sourceimage)
{
  return sfConfig::get('app_plugin_photos_path_for_web') . '/t-' . $sourceimage;
}
/**
 * Part of Plugin_Photos_Photo. Returns web path to photo small thumbnail file 
 * @param unknown_type $sourceimage
 */
function emoPluginPhotosPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_plugin_photos_path_for_web') . '/ts-' . $sourceimage;
}

function emoSupportPromoteBanner($filename)
{
	return sfConfig::get('app_promote_banner_path_for_web') .  $filename;
}

function emoSupportPromoteBannerThumb($filename)
{
  return sfConfig::get('app_promote_banner_path_for_web') . 't-' . $filename;
}

function emoSupportPromoteBannerDefault($filename, $skin)
{
  return sfConfig::get('app_promote_banner_default_path_for_web') . $skin . '/' . $filename;
}

function emoSupportPromoteBannerEmbedCode($promoteUrl, $bannerUrl)
{
	return '<a href="' . $promoteUrl . ' " target="_blank"><img src="' . $bannerUrl . '" border="0" /></a>';
}

function emoCurrencyConvertor($sum, $currency = null)
{
	if (!isset($currency)){
		$currency = sfConfig::get('app_currency_default');
	}
	
	return format_currency($sum * (float)sfConfig::get('app_currency_rate_' . $currency), $currency, sfContext::getInstance()->getUser()->getCulture());
}

/**
 * Returns the config the name of the gadget, based on the type key (ex Gadgets Plugin, Blog Plugin etc)
 * @param unknown_type $typeKey
 */
function emoPluginTypeName($typeKey)
{
	$gadgets = sfConfig::get('app_plugins'); 
	return $gadgets[$typeKey]['name'];
}



/**
 * SKIN FUNCTIONS
 */
function emoSkinPath($skinId)
{
	return sfConfig::get('app_view_skin_container_path') . '/skin-' . $skinId;  
}

function emoSkinImagePath($filename)
{
	return sfConfig::get('app_view_skin_path') . '/images/' . $filename;
}

function emoCommonImagePath($filename)
{
	return sfConfig::get('app_view_common_images_path') . '/' . $filename;
}

function emoSkinCssPath()
{
	return sfConfig::get('app_view_skin_path') . '/css/main.css';
}

function emoEditorCssPath()
{
	return sfConfig::get('app_view_skin_path') . '/css/editor.css';
}

function emoEditorSkinName()
{
	return 'emo-skin-0';
}

function emoCommonCssPath()
{
	return sfConfig::get('app_view_common_css_path');
}