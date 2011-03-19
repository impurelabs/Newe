<?php use_javascript('jquery.form.js')?>

<form action="<?php echo $photoEditUrl ?>" method="post" id="photo-description-form"><?php echo $form->renderHiddenFields()?>
	<?php echo $form->renderGlobalErrors();?>

<div class="mt-2"></div>

	<?php echo $form['description']->render(array('class' => 'span-10'))?>
	<?php echo $form['description']->renderError()?>


<div class="mt-3" id="photo-description-button-container">
<button type="submit" class="mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Save');?></button>
<a href="javascript: void(0)" id="photo-description-cancel"><span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?></a></div>
<!-- photo-description-button-container end --></form>

<script type="text/javascript">
  $(document).ready(function() {
      $("#photo-description-form").ajaxForm({
          target: "#photo-description-form",
		  dataType: 'json',
          success: function(response){
			  if (response.status == true){
				  $('#popup').dialog('close');
				  
				  $('#photo-description-container').slideUp('fast', function(){
					$('#photo-description-container').html(response.htmlContent);	  
					$('#photo-description-container').slideDown('fast', function(){
						emoFlash('<?php echo __('Caption successfully saved!');?>');	
					});
				  });
			  }
		  },
          beforeSubmit: function(){
			  $("#photo-description-button-container").html('<?php echo image_tag('indicator.gif')?> <?php echo __('Saving')?>...');  
		  },
          type: "post"
      });
	  
	  $('#photo-description-cancel').click(function(){
    	 $('#popup').dialog('close');
      });

  });
</script>
