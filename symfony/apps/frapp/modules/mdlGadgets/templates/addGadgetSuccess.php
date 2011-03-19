<ul id="add-gadget-list" class="add-list">

	<li id="<?php echo $typeKey['activity'];?>" class="pb-2 mb-2 separator-b peekaboo-parent">
    	<button id="button-<?php echo $typeKey['activity']?>" class="gadget-add-button peekaboo-child right" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Add gadget')?></button>
		<a id="<?php echo $typeKey['activity']?>-help" href="javascript: void(0)" class="help-link peekaboo-child right mr-3"><span class="icon-button-help mr-1"></span><?php echo __('Find out more')?></a>
		<div class="mb-2"><h3 id="<?php echo $typeKey['activity'];?>-title"><?php echo __('Activity');?></h3></div>
		<div><?php echo __('activity feed')?></div>
	</li>
    
	<li id="<?php echo $typeKey['blog'];?>" class="pb-2 mb-2 separator-b peekaboo-parent">
        <button id="button-<?php echo $typeKey['blog']?>" class="gadget-add-button peekaboo-child right" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Add gadget')?></button>
        <a id="<?php echo $typeKey['blog']?>-help" href="javascript: void(0)" class="help-link peekaboo-child right mr-3"><span class="icon-button-help mr-1"></span><?php echo __('Find out more')?></a>
        <div class="mb-2"><h3 id="<?php echo $typeKey['blog'];?>-title"><?php echo __('Blog');?></h3></div>
        <div><?php echo __('blog description')?></div>
	</li>
    
    
	<li id="<?php echo $typeKey['content'];?>" class="pb-2 mb-2 separator-b peekaboo-parent">
	    <button id="button-<?php echo $typeKey['content']?>" class="gadget-add-button peekaboo-child right" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Add gadget')?></button>
        <a id="<?php echo $typeKey['content']?>-help" href="javascript: void(0)" class="help-link peekaboo-child right mr-3"><span class="icon-button-help mr-1"></span><?php echo __('Find out more')?></a>
        <div class="mb-2"><h3 id="<?php echo $typeKey['content'];?>-title"><?php echo __('Content');?></h3></div>
        <div><?php echo __('content description')?></div>
	</li>
    
    
	<li id="<?php echo $typeKey['identity'];?>" class="pb-2 mb-2 separator-b peekaboo-parent">
        <button id="button-<?php echo $typeKey['identity']?>" class="gadget-add-button peekaboo-child right" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Add gadget')?></button>
        <a id="<?php echo $typeKey['identity']?>-help" href="javascript: void(0)" class="help-link peekaboo-child right mr-3"><span class="icon-button-help mr-1"></span><?php echo __('Find out more')?></a>
        <div class="mb-2"><h3 id="<?php echo $typeKey['identity'];?>-title"><?php echo __('Identity');?></h3></div>
        <div><?php echo __('identity description')?></div>
	</li>
    
    
	<li id="<?php echo $typeKey['photos'];?>" class="pb-2 mb-2 separator-b peekaboo-parent">
        <button id="button-<?php echo $typeKey['photos']?>" class="gadget-add-button peekaboo-child right" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Add gadget')?></button>
        <a id="<?php echo $typeKey['photos']?>-help" href="javascript: void(0)" class="help-link peekaboo-child right mr-3"><span class="icon-button-help mr-1"></span><?php echo __('Find out more')?></a>
        <div class="mb-2"><h3 id="<?php echo $typeKey['photos'];?>-title"><?php echo __('Photos');?></h3></div>
        <div><?php echo __('photos description')?></div>
	</li>
    
    
	<li id="<?php echo $typeKey['tags'];?>" class="pb-2 mb-2 separator-b peekaboo-parent">
        <button id="button-<?php echo $typeKey['tags']?>" class="gadget-add-button peekaboo-child right" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Add gadget')?></button>
        <a id="<?php echo $typeKey['tags']?>-help" href="javascript: void(0)" class="help-link peekaboo-child right mr-3"><span class="icon-button-help mr-1"></span><?php echo __('Find out more')?></a>
        <div class="mb-2"><h3 id="<?php echo $typeKey['tags'];?>-title"><?php echo __('Tags');?></h3></div>
        <div><?php echo __('tags description')?></div>
	</li>
    
</ul>

<script type="text/javascript"><!--

  // Show the buttons on mouseover
  $(document).ready(function(){
	  // Create new gadget
	  $('.gadget-add-button').click(function(){
           
		  $('#add-gadget-container').html('<?php echo image_tag('indicator.gif')?>');
		  
	    $.post('<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'addGadget', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()))?>', { type_key: $(this).attr('id').substr(7) }, function(data){
      
          $('#popup').dialog('close');

          data = JSON.parse(data);
          
          $('#gadget-container').addGadget(data);
          $('#gadget-container').height($('#gadget-container').height() + $('#gadget-' + data.id).height());

          $('html, body').animate({
        	  scrollTop: $('#gadget-' + data.id).offset().top - 400
        	  }, 500);
                                     
		   });
     });
  });
</script>
