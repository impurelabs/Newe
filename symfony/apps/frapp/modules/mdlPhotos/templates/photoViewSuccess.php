<?php use_javascript('jquery.form.js')?>

<div class="cell-hd">
  <h2><?php echo $photo->getPlugin_Photos_Album()->getName()?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">
  <div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small strong" href="<?php echo $pluginUrl;?>">
        <?php echo $photo->getPlugin_Photos_Album()->getPlugin()->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <a class="small strong" href="<?php echo $albumUrl;?>">
    	<?php echo $photo->getPlugin_Photos_Album()->getName()?>
    </a>
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo __('Photo %1% of %2%', array('%1%' => $photo->getPosition(), '%2%' => $photoCount))?></span> </div>
  <!-- breadcrumbs end -->
  <div class="cell-bd-content">
    <div class="align-center">
      <div id="photo-container"> <img src="<?php echo $photo->getPhoto()?>" />
        <?php if(isset($neighbours['previous'])):?>
        <div class="previous-container"></div>
        <a id="previous-link" href="<?php echo $previousUrl;?>"> <span id="photo-previous-button" class="big-arrow-left"></span> </a>
        <?php endif?>
        <?php if(isset($neighbours['next'])):?>
        <div class="next-container"></div>
        <a id="next-link" href="<?php echo $nextUrl; ?>"> <span id="photo-next-button" class="big-arrow-right"></span> </a>
        <?php endif?>
      </div>
      <!-- photo-container end --> 
    </div>
    <div class="mb-4 mt-2 clearfix" style="width: 580px; margin: 0 auto">
      <div id="photo-description-container" class="caption-2">
        <?php echo $photo->getDescription()?>
      </div>
      <!-- photo-description-container -->
      <?php if ($pluginUpdatePermission): ?>
          <div class="right" id="photo-description-link">
            <a href="javascript: void(0)"><span class="icon-button-edit mr-1"></span><?php echo __('Edit photo caption');?></a>
          </div>
      <?php endif ?>
    </div>
    <!-- plugin-photos-caption end -->

    <div style="width: 580px; margin: 0 auto">
<?php include_component('emoComment', 'formAndList', array(
	'modelClass' => 'pluginPhotosPhoto', 
	'modelId' => $photo->getId(),
	'deleteUrl' => $commentDeleteUrl,
	'permSocial' => $permSocial,
	'permSocialTrusted' => $permSocialTrusted,
	'detailsForHerodot' => urlencode(serialize(array(
		'photo_filename' => $photo->getFilename(),
		'photo_url'      => $photoUrl,
		'owner_id'       => $thisMicrosite->getMemberId(),
		'microsite_id'   => $thisMicrosite->getId()
	)))
))?>
    </div>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>
<style type="text/css">
#photo-container {
	display: inline-block;
	position: relative
}

.previous-container {
	display: block;
	position: absolute;
	top: 0px;
	width: 50%;
	height: 100%;
	cursor: pointer;
	background-color: white;
	opacity: .0;
	filter: Alpha(Opacity = 0)
}

.next-container {
	display: block;
	position: absolute;
	top: 0px;
	right: 0;
	width: 50%;
	height: 100%;
	cursor: pointer;
	background-color: white;
	opacity: .0;
	filter: Alpha(Opacity = 0)
}

#photo-previous-button {
	position: absolute;
	top: 0;
	left: -40px;
	width: 30px;
	height: 30px
}

#photo-next-button {
	position: absolute;
	top: 0;
	right: -45px;
	width: 30px;
	height: 30px
}
</style>
<script type="text/javascript">
//
$(function(){

  $('.previous-container').mouseover(function(){ $('#photo-previous-button').toggleClass('big-arrow-left-active'); });
  $('.previous-container').mouseout(function(){ $('#photo-previous-button').toggleClass('big-arrow-left-active'); });
  $('.previous-container').click(function(){ location.href = $('#previous-link').attr('href') });
  $('.next-container').mouseover(function(){ $('#photo-next-button').toggleClass('big-arrow-right-active'); });
  $('.next-container').mouseout(function(){ $('#photo-next-button').toggleClass('big-arrow-right-active'); });
  $('.next-container').click(function(){ location.href = $('#next-link').attr('href') });
	
<?php if ($pluginUpdatePermission): ?> 
  $("#photo-description-link").click(function() {
	  $('#popup').dialog({
                title: '<?php echo __('Edit photo caption');?>',
				modal: true,
				draggable: false,
                show: 'clip',
                hide: 'clip',
                width: 400,
                height: 220,
                resizable: false,
				open: function(){
					$(this).html('<div class="mt-4 align-center"><?php echo image_tag('indicator.gif');?></div>');					
					$(this).load("<?php echo $photoEditUrl ?>");
				}
              });
	  
  });
<?php endif ;?>


});
</script> 
