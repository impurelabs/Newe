<div class="p-2">
  <div class="cell-hd">
    <h2><?php echo __('Edit gadget "%1%"', array('%1%' => $gadget->getName()))?></h2>
  </div>
  <!--  cell-head end -->
  
  <div class="cell-bd">
  
  	<div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'edit', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $gadget->getPlugin()->getSlug()));?>">
        <?php echo $gadget->getPlugin()->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo  $gadget->getName()?></span> </div>
    <!-- breadcrumbs end -->
  
    <div class="cell-bd-content">
		<form method="post" id="gadget-edit-form" action="<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'editGadget', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $gadget->getPlugin()->getSlug()));?>?gid=<?php echo $gadget->getId();?>">
        	<div id="gadget-buttons-container" class="align-right">
          		<button type="button" id="gadget-save-button" class="mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Save')?></button>
          		<a href="<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $gadget->getPlugin()->getSlug()));?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?></a>
            </div>
  
        <div id="gadget-form-target" style="position: absolute; top: 5px; width: 550px; text-align: center; display: none"></div>
        <?php echo $form->renderGlobalErrors()?> 
		<?php echo $form->renderHiddenFields()?> 
		
		<?php echo $form['gadget_name']->renderLabel()?><br />
        <?php echo $form['gadget_name']->render(array('style' => 'width: ' . $gadget['width'] . 'px'))?><br />
        <?php echo $form['gadget_name']->renderError(); ?>
        <div class="mt-3"></div>
        
        
      </form>
    </div>
    <!-- cell-bd-content --> 
  </div>
  <!-- cell-bd end -->
  <div class="cell-ft"></div>
</div>
<script type="text/javascript">


$(document).ready(function(){

    $('#gadget-save-button').click(function(){
      $('#gadget-buttons-container').children().remove();
        $('#gadget-buttons-container').append('<?php echo image_tag('indicator.gif')?>');

        beforeGadgetEdit();
        
      $('#gadget-edit-form').submit();
    });
      
    
  });

  function beforeGadgetEdit(){
      $('#gadget-buttons-container').html('');
      $('#gadget-buttons-container').append('<?php echo image_tag('indicator.gif')?>');
      
  }

  
</script> 
