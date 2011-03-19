<div class="admin-cell mt-4 align-right">
	<button onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'edit', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>'"><span class="icon-button-edit mr-1"></span><?php echo __('Edit Layout');?></button>
</div>
<ul id="gadget-container">
<?php foreach ($gadgets as $gadget): ?>
	<li class="gadget gadget-<?php echo $gadget['skin'];?> peekaboo-parent" 
	    style="left: <?php echo $gadget['coord_x'];?>px; top: <?php echo $gadget['coord_y']?>px; width: <?php echo $gadget['width'] - 10 ?>px; height: <?php echo $gadget['height'] ?>px;  ">
		
<?php 
include_component(
	'pluginGadgets', 
	'gadget' . ucfirst($gadget['type_key']), 
	array(
		'parameters' => $gadget['parameters'],
		'editUrl' => url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'editGadget', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug())). '?gid=' .$gadget['id']
	)
)
?>	
	</li>
	<?php endforeach;?>
</ul>
<!-- gadget-container end -->





<style type="text/css">
#gadget-container { position: relative; height: <?php echo $containerHeight?>px; width: 950px; margin: 0 auto }
#gadget-container li { position: absolute; }
</style>

<script type="text/javascript">
    $(document).ready(function(){

      $('.gadget').each(function(){
		gadgetHeight = $(this).height();
	
		hdObj = $(this).children('.gadget-hd');
		if (hdObj.length <= 0 || hdObj.height() == 0){
			hdHeight = 0;
		} else {
			hdHeight = hdObj.height() + parseInt(hdObj.css('border-top-width')) + parseInt(hdObj.css('border-bottom-width')) + parseInt(hdObj.css('padding-top')) + parseInt(hdObj.css('padding-bottom'));
		}
		
		bdObj = $(this).children('.gadget-bd');
		if (bdObj.length <= 0 || bdObj.height() == 0){
			bdSurroundingHeight = 0;
		} else {
			bdSurroundingHeight = parseInt(bdObj.css('border-top-width')) + parseInt(bdObj.css('border-bottom-width')) + parseInt(bdObj.css('padding-top')) + parseInt(bdObj.css('padding-bottom'));
		}
		
		ftObj = $(this).children('.gadget-ft');
		if (ftObj.length <= 0 || ftObj.height() == 0){
			ftHeight = 0;
		} else {
			ftHeight = ftObj.height() + parseInt(ftObj.css('border-top-width')) + parseInt(ftObj.css('border-bottom-width')) + parseInt(ftObj.css('padding-top')) + parseInt(ftObj.css('padding-bottom'));
		}


		bdObj.height(gadgetHeight -  hdHeight - bdSurroundingHeight - ftHeight);				  
					
		
      });
    });
  </script>
