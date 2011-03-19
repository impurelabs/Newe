<script type="text/javascript" src="/js/vendor/tiny_mce/tiny_mce.js"></script>

<div class="cell-hd">
  <h2><?php echo __('Add new page in "%1%"', array('%1%' => $plugin->getName()))?></h2>
</div>
<!--  cell-head end -->

<div id="page-content" class="cell-bd">
  <div class="separator-b pl-2"><!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small" href="<?php echo url_for(array('sf_route' => 'plugin_pages_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()))?>">
		<?php echo $plugin->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo __('Add new page')?></span> </div>
  <!-- breadcrumbs end -->
  <div class="cell-bd-content">
    <div class="page-buttons-container mb-3 align-right">
      <button class="page-save-button nr-2" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Add')?></button>
      <a href="<?echo url_for(array('sf_route' => 'plugin_pages_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()));?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?></a></div>
    <div id="page-form-container">
      <?php include_partial('addForm', array('form' => $form, 'plugin' => $plugin))?>
    </div>
    <!-- page-form-container-end -->
    
    <div class="page-buttons-container mt-3 align-right">
      <button class="page-save-button mr-2" type="submit"><span class="icon-button-save mr-1"></span><?php echo __('Add')?></button>
      <a href="<?php echo url_for(array('sf_route' => 'plugin_pages_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()));?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?></a></div>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end --> 
<div class="cell-ft"></div>

<script type="text/javascript">
    $(document).ready(function(){
      //Remove the "Add page" button
        $('#page-add-button').remove(); 
        
  	  $('.page-save-button').click(function(){
  	  	  $('.page-buttons-container').children().remove();
    	  	$('.page-buttons-container').append('<?php echo image_tag('indicator.gif')?>');
    	  	$('#page-form').submit();
  	  });
    });
</script> 
