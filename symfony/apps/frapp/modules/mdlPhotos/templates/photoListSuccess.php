<div class="cell-hd">
  <h2><?php echo $album->getName()?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">
  <?php if ($pluginUpdatePermission):?>
  <div class="admin-cell">
    <button onclick="location.href='<?php echo $addPhotosUrl;?>'" type="button"><span class="icon-button-add mr-1"></span><?php echo __('Add Photos')?></button>
    <button onclick="location.href='<?php echo $albumEditUrl;?>'" type="button"><span class="icon-button-edit mr-1"></span><?php echo __('Edit Album')?></button>
    <button id="album-delete-button" type="button"><span class="icon-button-delete mr-1"></span><?php echo __('Delete Album')?></button>
  </div>
  <!-- admin-cell end -->
  <?php endif ;?>
  
  <div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> <a class="small strong" href="<?php echo $albumListUrl;?>"><?php echo $album->getPlugin()->getName()?></a> 
    <span class="small quiet">&raquo;</span> <span class="small"><?php echo $album->getName()?></span> 
  </div><!-- breadcrumbs end -->
  
  <div class="cell-bd-content">
  	<?php if (count($photos) > 0): ?>
        <ul id="photo-list" class="photo-list clearfix mb-3">
          <?php foreach ($photos as $photo):?>
          <li id="photo-container-<?php echo $photo->getId()?>"> 
            <span class="peekaboo-parent actionable" style="vertical-align:middle">
            	<a href="<?php echo url_for(array('sf_route' => 'plugin_photos_photo_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'album_id' => $album->getId(), 'plugin_slug' => $album->getPlugin()->getSlug(), 'photo_id' => $photo->getId())) ?>"> <img src="<?php echo emoPluginPhotosPhotoThumb($photo->getFilename())?>" /></a>
	          	<?php if ($pluginUpdatePermission):?>                
    		        <div id="photo-buttons-container-<?php echo $photo->getId()?>" class="admin-element-cell peekaboo-child"> 
                    	<a href="javascript: void(0)" id="photo-sort-handle-<?php echo $photo->getId();?>" class="photo-sort-handle  button-icononly"><span class="icon-button-sortmultiple-s"></span></a> 
                        <a href="javascript: void(0)" id="photo-delete-button-<?php echo $photo->getId();?>" class="photo-delete-button  button-icononly ml-2 mr-1"><span class="icon-button-delete-s"></span></a> 
                    </div><!-- photo-buttons-container end --> 
                <?php endif; ?>
            </span> 
           </li>
          <?php endforeach?>
        </ul>
        <?php if ($album->getDescription() !== ''):?>
        <div id="plugin-photos-caption" class="caption-2"><?php echo $album->getDescription()?></div>
        <?php endif;?>
    <?php else: ?>
    	<p class="mt-4 strong align-center"><?php echo __('No photos added.');?></p>
    <?php endif ?>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>



<?php if ($pluginUpdatePermission):?>
<div id="popup-delete-photo" style="display: none">
	<div class="mb-3"><?php echo __('Are you sure you want to delete this Photo?')?></div>
    <button type="button" class="button-yes mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Yes');?></button>
    <button type="button" class="button-no"><span class="icon-button-cancel mr-1"></span><?php echo __('No');?></button>
</div>
<div id="popup-delete-album" style="display: none">
	<div class="mb-3"><?php echo __('Are you sure you want to delete this Album? All the photos is it will be deleted permanently!')?></div>
    <button type="button" class="button-yes mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Yes');?></button>
    <button type="button" class="button-no"><span class="icon-button-cancel mr-1"></span><?php echo __('No');?></button>
</div>


<script type="text/javascript">
  $(document).ready(function(){	  

    // Sortable functionality
	  $('#photo-list').sortable({
	      handle: '.photo-sort-handle',
	      update: function(event, ui) {
	             
	             photoId = $(ui.item).attr('id').substr(16);
	             sortedPhotos = $('#photo-list').sortable('toArray');
	             res = '';
	             for (var i in sortedPhotos){
		               //res = res + sortedPhotos[i] + ' | ';
	                 if ($(ui.item).attr('id') == sortedPhotos[i]){
	                    photoPosition = parseInt(i) + 1;
	                 } 
	             }
	             $.post( '<?php echo $sortUrl;?>', { photo_id: photoId, photo_position: photoPosition}, function(data){
	                emoFlash('<?php echo __('Photos successfully sorted!');?>');
	                  
	             }); 
	          }
	    });

	    //Photo Delete functionality
	    $('.photo-delete-button').click(function(){
            deleteId = $(this).attr('id').substr(20);
			
			$('#popup-delete-photo').dialog({
				title: '<?php echo __('Delete Photo?');?>',
				show: 'clip',
				hide: 'clip',
				width: 350,
				height: 170,
				modal: true,
				resizable: false,
				open: function(){
					/* Create the yes, cancel events*/
					$('#popup-delete-photo').find('.button-yes').unbind().click(function(){
						$('#popup-delete-photo').dialog('close');
						
						//***** THE ACTUAL DELETING START *****//
						$.post( '<?php echo $photoDeleteUrl;?>', { photo_id: deleteId }, function(data){
							$('#photo-container-' + deleteId).fadeOut('fast');	
						}); 
						//***** THE ACTUAL DELETING end *****//
					});
					
					$('#popup-delete-photo').children('.button-no').unbind().click(function(){
						$('#popup-delete-photo').dialog('close');
					})
				}
			});	
	    });

		  //Album Delete functionality
	      $('#album-delete-button').click(function(){
			  
			  $('#popup-delete-album').dialog({
				title: '<?php echo __('Delete Album?');?>',
				show: 'clip',
				hide: 'clip',
				width: 350,
				height: 170,
				modal: true,
				resizable: false,
				open: function(){
					/* Create the yes, cancel events*/
					$('#popup-delete-album').find('.button-yes').unbind().click(function(){
						$('#popup-delete-album').dialog('close');
						
						//***** THE ACTUAL DELETING START *****//
						$.post( '<?php echo $albumDeleteUrl;?>', { }, function(data){
							location.href='<?php echo $albumListUrl;?>';
							$('#album-name-title').fadeOut('normal');
							$('#plugin-photos-caption').fadeOut('normal');
							$('#photo-list').fadeOut('normal');
						}); 
						//***** THE ACTUAL DELETING end *****//
					});
					
					$('#popup-delete-album').children('.button-no').unbind().click(function(){
						$('#popup-delete-album').dialog('close');
					})
				}
			});	
			
			
	      });
	});
</script> 
<?php endif ?>