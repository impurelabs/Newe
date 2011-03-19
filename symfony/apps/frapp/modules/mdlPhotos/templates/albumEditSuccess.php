<div class="cell-hd">
  <h2><?php echo __('Edit album')?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">
  <div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_photos_index', 'plugin_slug' => $album->getPlugin()->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>">
        <?php echo $album->getPlugin()->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_photos_photo_list', 'album_id' => $album->getId(), 'plugin_slug' => $album->getPlugin()->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>">
    	<?php echo $album->getName()?>
    </a>
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo __('Edit album')?></span> </div>
  <!-- breadcrumbs end -->
  
  <div class="cell-bd-content">
    <form id="photo-album-form"
	action="<?php echo url_for(array('sf_route' => 'plugin_photos_album_edit', 'album_id' => $album->getId(), 'plugin_slug' => $album->getPlugin()->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>"
	method="post">
      <?php echo $form->renderGlobalErrors()?> 
	  <?php echo $form->renderHiddenFields()?> 
	  <?php echo $form['name']->renderLabel(null, array('class' => 'left cell-140'))?> <br />
	  <?php echo $form['name']->render()?> <?php echo $form['name']->renderError()?>
	  <br /><br />
      <?php echo $form['description']->renderLabel(null, array('class' => 'left cell-140'))?><br />
	  <?php echo $form['description']->render()?> <?php echo $form['description']->renderError()?>
      <br /><br />
      <div class="" id="photo-album-button-container">
        <button type="button" id="photo-album-save-button" class="mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Save');?></button>
        <a href="<?php echo url_for(array('sf_route' => 'plugin_photos_photo_list', 'album_id' => $album->getId(), 'plugin_slug' => $album->getPlugin()->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>"> <span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?> </a></div>
      <!-- photo-album-button-container -->
    </form>
    <div class="clear mb-3"></div>
  </div>
  <!-- cell-bd-content end --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>
<div id="delete-photo-container" style="display: none"><?php echo __('Are you sure you want to delete this Photo?')?></div>
<style type="text/css">
#photo-list {
	margin-top: 10px
}

#photo-list li {
	height: 160px;
	width: 150px;
	margin: 0px 0px 5px 30px;
	float: left;
	text-align: center;
	position: relative
}

#photo-list li img {
	margin: 0 auto
}

#photo-list li .photo-buttons-container {
	position: absolute;
	width: 100%;
	height: 20px;
	bottom: 0;
	left: 0;
	display: none;
	text-align: center
}

.photo-sort-handle {
	position: absolute;
	top: 0;
	left: 60px;
	width: 25px;
	height: 20px
}

.photo-delete-button {
	position: absolute;
	top: -3px;
	left: 110px;
	width: 25px;
	height: 20px;
	cursor: pointer
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
	  // Submitting the form and adding the indicator before doing that
    $('#photo-album-save-button').click(function(){
  	  $('#photo-album-button-container').children().remove();

    	$('#photo-album-button-container').append($(document.createElement('img')).attr('src', '<?php echo emoSkinImagePath('indicator.gif')?>')
    	    	                                                                    .css('vertical-align', 'text-bottom')
    	    	                                                                    .css('margin-right', '10px'))
    	                                  .append($(document.createTextNode(' <?php echo __('Saving')?>...')));
        
      $('#photo-album-form').submit();  
    });
  });
</script> 
