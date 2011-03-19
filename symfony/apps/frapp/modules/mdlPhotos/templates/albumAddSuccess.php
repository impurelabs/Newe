<div class="cell-hd">
<h2><?php echo __('Add new album')?></h2>
</div>


<div class="cell-bd">
	<div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_photos_index', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>">
        <?php echo $plugin->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo __('Add new album')?></span> </div>
  <!-- breadcrumbs end -->

<div class="cell-bd-content">
<form id="album_form"
	action="<?php echo url_for(array('sf_route' => 'plugin_photos_album_add', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()));?>"
	method="post"><?php echo $form->renderHiddenFields()?> <?php echo $form->renderGlobalErrors()?>

<?php echo $form['name']->renderLabel()?> <br />
<?php echo $form['name']->render(array('class' => 'span-11'))?> <?php echo $form['name']->renderError()?>

<div class="mt-2"></div>

<?php echo $form['description']->renderLabel()?> <br />
<?php echo $form['description']->render(array('class' => 'span-11'))?>
<?php echo $form['description']->renderError()?>

<div class="mt-3"></div>

<div id="photos-buttons-container">
<button id="album-save-button" type="button" ><span class="icon-button-add mr-1"></span><?php echo __('Add')?></button>
<a href="<?echo url_for(array('sf_route' => 'plugin_photos_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()));?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?></a></div>

</form>
</div><!-- cell-cbd-content -->
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>

<script type="text/javascript">
    $(document).ready(function(){
      // Save button functionality 
	    $('#album-save-button').click(function(){

		    // Before submitting, add an indicator instead of the buttons
	  	  $('#photos-buttons-container').children().remove();
	  	  $('#photos-buttons-container').append($(document.createElement('img')).attr('src', '<?php echo emoSkinImagePath('indicator.gif')?>')
	  		  	                                                                  .css('vertical-align', 'text-bottom')
	  		  	                                                                  .css('margin-right', '10px'))
	  	                                .append($(document.createTextNode('<?php echo __('Adding new album ...')?>')));

        $('#album_form').submit();
	  	                                  
	  	});
    });
  
  </script>
