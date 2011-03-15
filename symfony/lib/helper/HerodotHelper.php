<?php 

/**
 * Factory function which returns the right helper function for the $type parameter 
 * @param unknown_type $type
 * @param unknown_type $parameters
 */
function HerodotActivityOther($type, $parameters, $displayRequestButtons = false)
{
  $helperMethod = 'HerodotActivityOther' . $type;
   
  return $helperMethod($parameters, $displayRequestButtons);
}

/**
 * Helper to display activity of type ACTIVITY_PLUGINPHOTOS_UPLOAD
 * @param unknown_type $parameters
 */
function HerodotActivityOther1($parameters)
{
	$memberLogo    = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
	$memberName    = $parameters['variables']['member_display_name'];
	$memberUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
	$albumName     = $parameters['variables']['album_name'];
	$albumUrl      = $parameters['variables']['album_url'];
	$photoFilename = emoPluginPhotosPhotoThumbS($parameters['variables']['photo_filename']);
	$photoUrl      = $parameters['variables']['photo_url'];
	
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = format_number_choice('[1] uploaded a photo in the album |(1,+Inf] uploaded %1% photos in the album ', array('%1%' => 1), 1);
  
  
  return <<<EMO
<div class="activity-thumb">
  <a href="$memberUrl"><img src="$memberLogo" /></a>
</div>
<div class="activity-body">
  <div class="quiet spacer-bottom"><a href="$memberUrl">{$memberName}</a> $typeText <a href="$albumUrl">$albumName</a></div>
  <a href="$photoUrl"><img src="$photoFilename" class="plugin-photos-thumb" /></a>
  <div class="spacer-top timestampable">{$createdAt}</div>
</div>
EMO;


}

/**
 * Helper to display activity of type ACTIVITY_PLUGINBLOG_POST
 * @param unknown_type $parameters
 */
function HerodotActivityOther2($parameters)
{
  $memberLogo   = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName   = $parameters['variables']['member_display_name'];
  $memberUrl    = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $postName     = $parameters['variables']['post_name'];
  $postUrl      = $parameters['variables']['post_url'];
  $pluginName   = $parameters['variables']['plugin_name'];
  $pluginUrl    = $parameters['variables']['plugin_url'];
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' added a new post in ');
               
  return <<<EMO
<div class="activity-thumb">
  <a href="$memberUrl"><img src="$memberLogo" /></a>
</div>
<div class="activity-body">
  <div class="quiet spacer-bottom">
    <a href="$memberUrl">$memberName</a> $typeText <a href="$pluginUrl">$pluginName</a>: 
    <a href="$postUrl" class="important-link">$postName</a>
  </div> 
  <div class="timestampable spacer-top">{$createdAt}</div>
</div>  
EMO;
  
}


/**
 * Helper to display activity of type ACTIVITY_CAUSE_CREATION
 * @param unknown_type $parameters
 */
function HerodotActivityOther100($parameters)
{
  $memberLogo            = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName            = $parameters['variables']['member_display_name'];
  $memberUrl             = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $causeMicrositeName    = $parameters['variables']['cause_microsite_name'];
  $causeMicrositeUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['cause_microsite_slug']));
  $causeMicrositeLogo    = emoLogoT2($parameters['variables']['cause_microsite_sourceimage']);

  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' created the cause ');
  
  
  return <<<EMO
  <div class="activity-thumb">
    <a href="$memberUrl"><img src="$memberLogo" /></a>
  </div>
  <div class="activity-body">
    <div class="quiet spacer-bottom">
      <a href="$memberUrl">$memberName</a> $typeText 
      <a href="$causeMicrositeUrl" class="member-passport important-link"><img src="$causeMicrositeLogo" />$causeMicrositeName</a>
    </div>
    <div class="timestampable">{$createdAt}</div>
  </div>
EMO;

}

/**
 * Helper to display activity of type ACTIVITY_CAUSE_PROMOTE
 * @param unknown_type $parameters
 */
function HerodotActivityOther101($parameters)
{
	$memberLogo         = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName         = $parameters['variables']['member_display_name'];
  $memberUrl          = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $causeMicrositeName = $parameters['variables']['cause_microsite_name'];
  $causeMicrositeUrl  = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['cause_microsite_slug']));
  $causeMicrositeLogo = emoLogoT2($parameters['variables']['cause_microsite_sourceimage']);
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' started promoting the cause ');
  
  return <<<EMO
  <div class="activity-thumb">
	  <a href="$memberUrl"><img src="$memberLogo" /></a>
	</div>
	<div class="activity-body">
	  <div class="quiet spacer-bottom"><a href="$memberUrl" class="important-link">$memberName</a> $typeText 
	    <a href="$causeMicrositeUrl" class="member-passport"><img src="$causeMicrositeLogo" /> $causeMicrositeName</a>
	  </div>
	  <div class="timestampable">{$createdAt}</div>
	</div>
EMO;

}


/**
 * Helper to display activity of type ACTIVITY_CAUSE_PLEDGE
 * @param unknown_type $parameters
 */
function HerodotActivityOther102($parameters, $displayRequestButtons = false)
{
  $memberLogo         = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName         = $parameters['variables']['member_display_name'];
  $memberUrl          = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $causeMicrositeName = $parameters['variables']['cause_microsite_name'];
  $causeMicrositeUrl  = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['cause_microsite_slug']));
  $causeMicrositeLogo = emoLogoT2($parameters['variables']['cause_microsite_sourceimage']);
  $sum                = emoCurrencyConvertor($parameters['variables']['sum'], sfContext::getInstance()->getUser()->getCurrency());
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' pledged to sponsor, the cause %1%, with ', array('%1%' => '<a href="' . $causeMicrositeUrl . '" class="member-passport"><img src="' . $causeMicrositeLogo . '" /> ' . $causeMicrositeName . '</a>'));
  
if ($displayRequestButtons){ 
    $requestButtons = "<div class=\"request-buttons peekaboo-child\">
  <button onclick=\"herodotRequestAllow({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_center', 'action' => 'causePledgeApprove')) . "', parameters : { pledge_sum_id : {$parameters['model_id']}}})\"><span class=\"request-allow icon-button-icon-save\"></span></button> 
  <button onclick=\"herodotRequestDelete({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_center', 'action' => 'causePledgeDeny')) . "', parameters : { pledge_sum_id : {$parameters['model_id']}}})\"><span class=\"request-delete icon-button-icon-delete\"></span></button>
</div>";
  } else {
    $requestButtons = '';
  }
  
  return <<<EMO
  <div class="activity-thumb">
    <a href="$memberUrl"><img src="$memberLogo" /></a>
  </div>
  <div class="activity-body">
    <div class="quiet spacer-bottom">
      <a href="$memberUrl" class="important-link">$memberName</a> $typeText
      <h5>$sum</h5>
    </div>
    
    <div class="timestampable">{$createdAt}</div>
  </div>
  $requestButtons
EMO;

}

/**
 * Helper to display activity of type ACTIVITY_CAMPAIGN_CREATION
 * @param unknown_type $parameters
 */
function HerodotActivityOther107($parameters, $displayRequestButtons = false)
{
  $memberLogo            = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName            = $parameters['variables']['member_display_name'];
  $memberUrl             = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $causeMicrositeName    = $parameters['variables']['cause_microsite_name'];
  $causeMicrositeUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['cause_microsite_slug']));
  $causeMicrositeLogo    = emoLogoT2($parameters['variables']['cause_microsite_sourceimage']);
  $campaignMicrositeName = $parameters['variables']['campaign_microsite_name'];
  $campaignMicrositeUrl  = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['campaign_microsite_slug']));
  $campaignMicrositeLogo = emoLogoT2($parameters['variables']['campaign_microsite_sourceimage']);

  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' created a campaign for the cause ');
  
  if ($displayRequestButtons){ 
    $requestButtons = "<div class=\"request-buttons peekaboo-child\">
  <button onclick=\"herodotRequestAllow({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_center', 'action' => 'campaignApprove')) . "', parameters : { campaign_id : {$parameters['model_id']}}})\"><span class=\"request-allow icon-button-save\"></span></button> 
  <button onclick=\"herodotRequestDelete({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_center', 'action' => 'campaignDeny')) . "', parameters : { campaign_id : {$parameters['model_id']}}})\"><span class=\"request-delete icon-button-delete\"></span></button>
</div>";
  } else {
    $requestButtons = '';
  }
  
  return <<<EMO
  <div class="activity-thumb">
    <a href="$memberUrl"><img src="$memberLogo" /></a>
  </div>
  <div class="activity-body">
    <div class="quiet spacer-bottom">
      <a href="$memberUrl">$memberName</a> $typeText 
      <a href="$causeMicrositeUrl">$causeMicrositeName</a>
    </div>
    <div>
      <a href="$campaignMicrositeUrl" class="member-passport important-link"><img src="$campaignMicrositeLogo" /> $campaignMicrositeName</a> 
    </div>
    <div class="timestampable">{$createdAt}</div>
  </div>
  $requestButtons
EMO;

}

/**
 * Helper to display activity of type ACTIVITY_CAMPAIGN_PROMOTE
 * @param unknown_type $parameters
 */
function HerodotActivityOther108($parameters)
{
  $memberLogo         = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName         = $parameters['variables']['member_display_name'];
  $memberUrl          = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $campaignMicrositeName = $parameters['variables']['campaign_microsite_name'];
  $campaignMicrositeUrl  = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['campaign_microsite_slug']));
  $campaignMicrositeLogo = emoLogoT2($parameters['variables']['campaign_microsite_sourceimage']);
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' started promoting the campaign ');
  
  return <<<EMO
  <div class="activity-thumb">
    <a href="$memberUrl"><img src="$memberLogo" /></a>
  </div>
  <div class="activity-body">
    <div class="quiet spacer-bottom"><a href="$memberUrl" class="important-link">$memberName</a> $typeText 
      <a href="$campaignMicrositeUrl" class="member-passport"><img src="$campaignMicrositeLogo" /> $campaignMicrositeName</a>
    </div>
    <div class="timestampable">{$createdAt}</div>
  </div>
EMO;

}

/**
 * Helper to display activity of type ACTIVITY_CAMPAIGN_PLEDGE
 * @param unknown_type $parameters
 */
function HerodotActivityOther109($parameters, $displayRequestButtons = false)
{
  $memberLogo         = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName         = $parameters['variables']['member_display_name'];
  $memberUrl          = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $campaignMicrositeName = $parameters['variables']['campaign_microsite_name'];
  $campaignMicrositeUrl  = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['campaign_microsite_slug']));
  $campaignMicrositeLogo = emoLogoT2($parameters['variables']['campaign_microsite_sourceimage']);
  $sum                = emoCurrencyConvertor($parameters['variables']['sum'], sfContext::getInstance()->getUser()->getCurrency());
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' pledged to sponsor, the campaign %1%, with ', array('%1%' => '<a href="' . $campaignMicrositeUrl . '" class="member-passport"><img src="' . $campaignMicrositeLogo . '" /> ' . $campaignMicrositeName . '</a>'));
  
if ($displayRequestButtons){ 
    $requestButtons = "<div class=\"request-buttons peekaboo-child\">
  <button onclick=\"herodotRequestAllow({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_center', 'action' => 'campaignPledgeApprove')) . "', parameters : { pledge_sum_id : {$parameters['model_id']}}})\"><span class=\"request-allow icon-button-icon-save\"></span></button> 
  <button onclick=\"herodotRequestDelete({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_center', 'action' => 'campaignPledgeDeny')) . "', parameters : { pledge_sum_id : {$parameters['model_id']}}})\"><span class=\"request-delete icon-button-icon-delete\"></span></button>
</div>";
  } else {
    $requestButtons = '';
  }
  
  return <<<EMO
  <div class="activity-thumb">
    <a href="$memberUrl"><img src="$memberLogo" /></a>
  </div>
  <div class="activity-body">
    <div class="quiet spacer-bottom">
      <a href="$memberUrl" class="important-link">$memberName</a> $typeText
      <h5>$sum</h5>
    </div>
    
    <div class="timestampable">{$createdAt}</div>
  </div>
  $requestButtons
EMO;

}



/**
 * Helper to display activity of type ACTIVITY_CONNECTION_ADD_SENDER
 * @param unknown_type $parameters
 */
function HerodotActivityOther200($parameters, $displayRequestButtons = false)
{
	$senderMemberLogo    = emoLogoT2($parameters['variables']['sender_member_logo_sourceimage']);
  $senderMemberName    = $parameters['variables']['sender_member_display_name'];
  $senderMemberUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['sender_member_microsite_slug']));
  $getterMemberLogo    = emoLogoT2($parameters['variables']['getter_member_logo_sourceimage']);
  $getterMemberName    = $parameters['variables']['getter_member_display_name'];
  $getterMemberUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['getter_member_microsite_slug']));
	
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __('added as contact');
  
  if ($displayRequestButtons){ 
    $requestButtons = "<div class=\"request-buttons peekaboo-child\">
  <button onclick=\"herodotRequestAllow({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_connection_actions', 'action' => 'approve')) . "', parameters : { connection_id : {$parameters['model_id']}}})\"><span class=\"request-allow icon-button-icon-save\"></span></button> 
  <button onclick=\"herodotRequestDelete({buttonElement: this, url : '" . url_for(array('sf_route' => 'my_connection_actions', 'action' => 'delete')) . "', parameters : { connection_id : {$parameters['model_id']}}})\"><span class=\"request-delete icon-button-icon-delete\"></span></button>
</div>";
  } else {
    $requestButtons = '';
  }
  
  return <<<EMO
<div class="activity-thumb">
  <a href="$senderMemberUrl"><img src="$senderMemberLogo" /></a>
</div>
<div class="activity-body">
  <div class="spacer-bottom quiet">
    <a href="$senderMemberUrl" class="important-link">$senderMemberName</a> $typeText
      <a href="$getterMemberUrl" class="member-passport"><img src="$getterMemberLogo" /> $getterMemberName</a>
  </div>
  <div class="timestampable spacer-top">$createdAt</div>
</div>
$requestButtons
EMO;
  
}

/**
 * Helper to display activity of type ACTIVITY_CONNECTION_ADD_GETTER
 * @param unknown_type $parameters
 */
function HerodotActivityOther201($parameters)
{
  $senderMemberLogo    = emoLogoT2($parameters['variables']['sender_member_logo_sourceimage']);
  $senderMemberName    = $parameters['variables']['sender_member_display_name'];
  $senderMemberUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['sender_member_microsite_slug']));
  $getterMemberLogo    = emoLogoT2($parameters['variables']['getter_member_logo_sourceimage']);
  $getterMemberName    = $parameters['variables']['getter_member_display_name'];
  $getterMemberUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['getter_member_microsite_slug']));
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __('added as contact');
  
  return <<<EMO
<div class="activity-thumb">
  <a href="$senderMemberUrl"><img src="$senderMemberLogo" /></a>
</div>
<div class="activity-body">
  <div class="spacer-bottom quiet">
    <a href="$senderMemberUrl" class="important-link">$senderMemberName</a> $typeText 
    <a href="$getterMemberUrl" class="member-passport"><img src="$getterMemberLogo" /> $getterMemberName</a>
  </div>
  <div class="timestampable spacer-top">{$createdAt}</div>
</div>
EMO;
  
}



/**
 * Helper to display activity of type ACTIVITY_PLUGINPHOTOS_COMMENT
 * @param unknown_type $parameters
 */
function HerodotActivityOther203($parameters, $displayRequestButtons = false)
{
  $memberLogo    = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName    = $parameters['variables']['member_display_name'];
  $memberUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $photoFilename = emoPluginPhotosPhotoThumbS($parameters['variables']['photo_filename']);
  $photoUrl      = $parameters['variables']['photo_url'];
  $comment       = $parameters['variables']['comment'];
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' wrote a comment for the photo ');
  
if ($displayRequestButtons){ 
    $requestButtons = "<div class=\"request-buttons peekaboo-child\">
  <button onclick=\"herodotRequestAllow({buttonElement: this, url : '" . url_for(array('sf_route' => 'comment_post', 'action' => 'pluginPhotosPhoto')) . "', parameters : { id : {$parameters['model_id']}}})\"><span class=\"request-allow icon-button-icon-save\"></span></button> 
  <button onclick=\"herodotRequestDelete({buttonElement: this, url : '" . url_for(array('sf_route' => 'comment_delete', 'action' => 'pluginPhotosPhoto')) . "', parameters : { id : {$parameters['model_id']}}})\"><span class=\"request-delete icon-button-icon-delete\"></span></button>
</div>";
  } else {
    $requestButtons = '';
  }
  
  
  return <<<EMO
<div class="activity-thumb">
  <a href="$memberUrl"><img src="$memberLogo" /></a>
</div>
<div class="activity-body">
  <div class="spacer-bottom quiet"><a href="$memberUrl" class="important-link">$memberName</a> $typeText </div>
  <div>
    <a href="$photoUrl"  style="display: table-cell; "><img src="$photoFilename"  class="plugin-photos-thumb" /></a> 
    <span style="display: table-cell; vertical-align: top; padding-left: 10px;">" $comment "</span>
  </div>
  
  <div class="timestampable spacer-top">{$createdAt}</div>
</div>
$requestButtons
EMO;
  
}

/**
 * Helper to display activity of type ACTIVITY_PLUGINBLOG_COMMENT
 * @param unknown_type $parameters
 */
function HerodotActivityOther204($parameters, $displayRequestButtons = false)
{
  $memberLogo    = emoLogoT2($parameters['variables']['member_logo_sourceimage']);
  $memberName    = $parameters['variables']['member_display_name'];
  $memberUrl     = url_for(array('sf_route' => 'microsite_index', 'microsite_slug' => $parameters['variables']['member_microsite_slug']));
  $postName      = $parameters['variables']['post_name'];
  $postUrl       = $parameters['variables']['post_url'];
  $comment   = $parameters['variables']['comment'];
  
  $createdAt = format_date($parameters['created_at'], 'f');
  $typeText = __(' wrote a comment for the blog post ');
  
  if ($displayRequestButtons){ 
    $requestButtons = "<div class=\"request-buttons peekaboo-child\">
	<button onclick=\"herodotRequestAllow({buttonElement: this, url : '" . url_for(array('sf_route' => 'comment_post', 'action' => 'pluginBlogPost')) . "', parameters : { id : {$parameters['model_id']}}})\"><span class=\"request-allow icon-button-icon-save\"></span></button> 
	<button onclick=\"herodotRequestDelete({buttonElement: this, url : '" . url_for(array('sf_route' => 'comment_delete', 'action' => 'pluginBlogPost')) . "', parameters : { id : {$parameters['model_id']}}})\"><span class=\"request-delete icon-button-icon-delete\"></span></button>
</div>";
  } else {
    $requestButtons = '';
  }
  
  return <<<EMO
<div class="activity-thumb">
  <a href="$memberUrl"><img src="$memberLogo" /></a>
</div>
<div class="activity-body">
  <div class="spacer-bottom quiet">
    <a href="$memberUrl" class="important-link">$memberName</a> $typeText 
    <a href="$postUrl">$postName</a>:
  </div>
  <div>"$comment"</div>
  <div class="spacer-top timestampable">{$createdAt}</div>
</div>
$requestButtons
EMO;
  
}









