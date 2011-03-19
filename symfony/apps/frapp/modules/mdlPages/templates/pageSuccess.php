<div class="cell-hd">
  <h2></h2>
</div> <!--  cell-head end -->


<div id="page-content" class="cell-bd">
	
    <?php if ($updatePermission):?>
<div class="admin-cell">
  <button
	  onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_pages_edit', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $page->getPlugin()->getSlug(), 'slug' => $sf_data->getRaw('page')->getSlug()))?>'"
	  type="button"><span class="icon-button-edit mr-1"></span><?php echo __('Edit page')?></button>
	<button id="page-delete-button"><span class="icon-button-delete mr-1"></span><?php echo __('Delete page')?></button>
	<button onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_pages_add', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $page->getPlugin()->getSlug()));?>'"
          type="button" id="page-add-button"><span class="icon-button-add mr-1"></span><?php echo __('Add new page')?></button>

</div><!-- admin-cell end -->

<div id="popup-delete" style="display: none">
	<div class="mb-3"><?php echo __('Are you sure you want to delete this Page? <br /> All the data in it will be lost!')?></div>
    <button type="button" class="button-yes mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Yes');?></button>
    <button type="button" class="button-no"><span class="icon-button-cancel mr-1"></span><?php echo __('No');?></button>
</div>
 
<script type="text/javascript">
$(document).ready(function(){
	$('#page-delete-button').click(function(){ 
		$('#popup-delete').dialog({
			title: '<?php echo __('Delete Page?');?>',
			show: 'clip',
			hide: 'clip',
			width: 350,
			height: 170,
			modal: true,
			resizable: false,
			open: function(){
				/* Create the yes, cancel events*/
				$('#popup-delete').find('.button-yes').unbind().click(function(){
					$('#popup-delete').dialog('close');
					
					//***** THE ACTUAL DELETING START *****//
					$('#page-content').fadeOut();
					$.post( '<?php echo url_for(array('sf_route' => 'plugin_pages_delete', 'microsite_slug' => $thisMicrosite->getSlug(),  'plugin_slug' => $page->getPlugin()->getSlug(), 'slug' => $sf_data->getRaw('page')->getSlug()))?>', { page_id: <?php echo $page->getId()?>}, function(data){
					  location.href ="<?php echo url_for(array('sf_route' => 'plugin_pages_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $page->getPlugin()->getSlug()))?>"
					}); 
					//***** THE ACTUAL DELETING END *****//
				});
				
				$('#popup-delete').children('.button-no').unbind().click(function(){
					$('#popup-delete').dialog('close');
				})
			}
		});	

	});
});

  
</script> 
<?php endif?>

<div class="cell-bd-content">
<h1><?php echo $page->getName()?></h1>
<?php echo $sf_data->getRaw('page')->getContent()?>
</div> <!-- cell-bd-content -->
</div><!-- cell-bd end -->
<div class="cell-ft"></div>

<!-- pages menu end -->

