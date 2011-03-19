<script type="text/javascript" src="/js/vendor/tiny_mce/tiny_mce.js"></script>
<?php use_javascript('jquery.form.js')?>

<div class="cell-hd">
  <h2> <?php echo __('Edit ')?> "<?php echo $post->getName()?>"</h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">
	<div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug()))?>">
        <?php echo $post->getPlugin()->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId(), 'slug' => $post->getSlug()))?>">
        <?php echo $post->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo __('Edit blog post')?></span> </div>
  <!-- breadcrumbs end -->
  
  <div class="cell-bd-content">
    <div class="align-right mb-2"><span
	class="blog-buttons-container" style="position: relative">
      <button class="blog-save-button" type="button" disabled="disabled"><span class="icon-button-save mr-1"></span><?php echo $post->getIsPublic() ? __('Update Post') : __('Update Draft')?></button>
      <?php if(!$post->getIsPublic()):?>
      <button class="blog-publish-button" type="button"><span class="icon-button-add mr-1"></span><?php echo __('Publish')?></button>
      <?php endif?>
      <button class="blog-preview-button" type="button"><span class="icon-button-preview mr-1"></span><?php echo __('Preview')?></button>
      <button type="button"
	onclick="location.href='<?php echo $post->getIsPublic()? url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId(), 'slug' => $post->getSlug())):
                                                           url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug())) ?>'"><span class="icon-button-cancel mr-1"></span><?php echo __('Close')?></button>
      </span><!-- blog-buttons-container --></div>
    <div id="blog-form-container">
      <form id="blog-form" method="post">
        <?php echo $form->renderHiddenFields()?> <?php echo $form->renderGlobalErrors();?> <?php echo $form['name']->renderLabel()?> <br />
        <?php echo $form['name']->render(array('class' => 'span-18'))?> <?php echo $form['name']->renderError()?>
        <div class="mt-3"></div>
        <?php echo $form['content']->renderLabel()?> <br />
        <?php echo $form['content']->render(array('class' => 'mceEditor'))?> <?php echo $form['content']->renderError()?>
        <div class="mt-3"></div>
      </form>
    </div>
    <!-- page-form-container-end -->
    
    <div class="align-right mb-2"><span
	class="blog-buttons-container" style="position: relative">
      <button class="blog-save-button" type="button" disabled="disabled"><span class="icon-button-save mr-1"></span><?php echo $post->getIsPublic() ? __('Update Post') : __('Update Draft')?></button>
      <?php if(!$post->getIsPublic()):?>
      <button class="blog-publish-button" type="button"><span class="icon-button-add mr-1"></span><?php echo __('Publish')?></button>
      <?php endif?>
      <button class="blog-preview-button" type="button"><span class="icon-button-preview mr-1"></span><?php echo __('Preview')?></button>
      <button type="button"
	      onclick="location.href='<?php echo $post->getIsPublic()? url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId(), 'slug' => $post->getSlug())):
                                                                 url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug())) ?>'"><span class="icon-button-cancel mr-1"></span><?php echo __('Close')?></button>
      </span><!-- blog-buttons-container --></div>
  </div>
  <!--cell-bd-content--> 
  
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>

<?php include_partial('default/wysiwygEditor', array('width' => 688, 'height' => 500))?>
<script type="text/javascript">

  $(document).ready(function(){
	  
    $('#blog-form').children().keydown(onChangeCallback);
	  
    $('.blog-save-button').click(function(){
      $('#blog-form').ajaxSubmit({
    	  type: "post",
    	  url: "<?php echo url_for(array('sf_route' => 'plugin_blog_edit', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId()))?>",
    	  beforeSerialize: function(){
          var editor = tinyMCE.get('plugin_blog_post_content');
          $('#plugin_blog_post_content').val(editor.getContent());  
        },
        beforeSubmit: beforeBlogSubmit,
        success: blogSaveSuccess
      });
    });

    $('.blog-publish-button').click(function(){
    	$('#plugin_blog_post_is_public').val('1');
    	$('#blog-form').ajaxSubmit({
            type: "post",
            url: "<?php echo url_for(array('sf_route' => 'plugin_blog_publish', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId()))?>",
            beforeSerialize: function(){
              var editor = tinyMCE.get('plugin_blog_post_content');
              $('#plugin_blog_post_content').val(editor.getContent());  
            },
            beforeSubmit: beforeBlogSubmit,
            success: blogPublishSuccess
          });
    });

    $('.blog-preview-button').click(function(){
    	$('#blog-form').attr('action', '<?php echo url_for(array('sf_route' => 'plugin_blog_preview', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug()))?>')
    	               .attr('target', '_blank')
    	               .submit();
      });
      
    
  });

  function onChangeCallback()
  {
	  if ($('.blog-save-button').is(':disabled')){
	        $('.blog-save-button').removeAttr('disabled');
	        $('.blog-save-button').removeAttr('disabled-hack');
	      }
  }
	  
  
  function beforeBlogSubmit(){
      $('.blog-buttons-container').html('');
      $('.blog-buttons-container').append('<?php echo image_tag('indicator.gif')?>');
  }

  function blogSaveSuccess(responseText)
  {
	  response = JSON.parse(responseText);

		// Add back the buttons
    $('.blog-buttons-container').children().remove();

    $(document.createElement('button')).attr('disabled', 'disabled')
									   .attr('disabled-hack', 'disabled')
									   .attr('class', 'blog-save-button')
									   .html('<span class="icon-button-save mr-1"></span><?php echo $post->getIsPublic() ? __('Update Post') : __('Update Draft')?>')
									   .click(function(){
											$('#blog-form').ajaxSubmit({
												type: "post",
												url: "<?php echo url_for(array('sf_route' => 'plugin_blog_edit', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId()))?>",
												beforeSerialize: function(){
												  var editor = tinyMCE.get('plugin_blog_post_content');
												  $('#plugin_blog_post_content').val(editor.getContent());  
												},
												beforeSubmit: beforeBlogSubmit,
												success: blogSaveSuccess
											 });
										   })
									   .appendTo('.blog-buttons-container');
																	
	  $('.blog-buttons-container').append(' ');
 
	  <?php if (!$post->getIsPublic()): ?>
    $(document.createElement('button')).attr('class', 'blog-publish-button')
                                       .html('<span class="icon-button-add mr-1"></span><?php echo __('Publish')?>')
                                       .click(function(){
																				      $('#plugin_blog_post_is_public').val('1');
																				      $('#blog-form').ajaxSubmit({
																				            type: "post",
																				            url: "<?php echo url_for(array('sf_route' => 'plugin_blog_publish', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId()))?>",
																				            beforeSerialize: function(){
																				              var editor = tinyMCE.get('plugin_blog_post_content');
																				              $('#plugin_blog_post_content').val(editor.getContent());  
																				            },
																				            beforeSubmit: beforeBlogSubmit,
																				            success: blogPublishSuccess
																				          });
																				    })
                                       .appendTo('.blog-buttons-container');
    
    $('.blog-buttons-container').append(' ');
    <?php endif ?>

    $(document.createElement('button')).html('<span class="icon-button-preview mr-1"></span><?php echo __('Preview')?>')
                                       .click(function(){
		                                    	   $('#blog-form').attr('action', '<?php echo url_for(array('sf_route' => 'plugin_blog_preview', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug()))?>')
		                                                        .attr('target', '_blank')
		                                                        .submit();
                                             })
                                       .appendTo('.blog-buttons-container');

    $('.blog-buttons-container').append(' ');
    
    $(document.createElement('button')).html('<span class="icon-button-cancel mr-1"></span><?php echo __('Close')?>')
									   .click(function(){
										   location.href = '<?php echo $post->getIsPublic()? 
										     url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId(), 'slug' => $post->getSlug())):
										     url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug())) ?>';
										})
										.appendTo('.blog-buttons-container');
    
	    
   if(response.status == true){
	   // Add the ok flash
	   emoFlash('Blog post updated successfully.');
      
   } else {
     // Append the errors after each element
     for (i in response.errors){
       $(document.createElement('ul')).addClass('error_list')
                                      .append($(document.createElement('li')).text(response.errors[i]))
                                      .insertAfter('#plugin_blog_post_' + i);
     }
      
         
   } 
  }

  function blogPublishSuccess(responseText)
  {
	  response = JSON.parse(responseText);
    
	  if(response.status == true){
		  location.href="<?php echo url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId(), 'slug' => $post->getSlug()))?>";
		} else {
      // Append the errors after each element
		  for (i in response.errors){
			  $(document.createElement('ul')).addClass('error_list')
			                                 .append($(document.createElement('li')).text(response.errors[i]))
			                                 .insertAfter('#plugin_blog_post_' + i);
		  }

		  // Add back the buttons
		  $('.blog-buttons-container').children().remove();

	      $(document.createElement('button')).attr('type', 'button')
																           .attr('class', 'blog-save-button')
																           .attr('disabled', 'disabled')
																           .attr('disabled-hack', 'disabled')
																           .text('<?php echo $post->getIsPublic() ? __('Update Post') : __('Update Draft')?>')
																           .click(function(){
																                 $('#blog-form').ajaxSubmit({
																                     type: "post",
																                     url: "<?php echo url_for(array('sf_route' => 'plugin_blog_edit', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId()))?>",
																                     beforeSerialize: function(){
																                       var editor = tinyMCE.get('plugin_blog_post_content');
																                       $('#plugin_blog_post_content').val(editor.getContent());  
																                     },
																                     beforeSubmit: beforeBlogSubmit,
																                     success: blogSaveSuccess
																                   });
																                 })
																           .prepend($(document.createElement('span')).attr('class', 'icon-save'))
																           .appendTo('.blog-buttons-container');
																
         $('.blog-buttons-container').append(' ');

      <?php if (!$post->getIsPublic()): ?>
		  $(document.createElement('button')).attr('type', 'button')
		                                     .attr('class', 'blog-publish-button')
		                                     .text('<?php echo __('Publish')?>')
		                                     .prepend($(document.createElement('span')).attr('class', 'icon-add'))
		                                     .click(function(){
																				      $('#plugin_blog_post_is_public').val('1');
																				      $('#blog-form').ajaxSubmit({
																				            type: "post",
																				            url: "<?php echo url_for(array('sf_route' => 'plugin_blog_publish', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId()))?>",
																				            beforeSerialize: function(){
																				              var editor = tinyMCE.get('plugin_blog_post_content');
																				              $('#plugin_blog_post_content').val(editor.getContent());  
																				            },
																				            beforeSubmit: beforeBlogSubmit,
																				            success: blogPublishSuccess
																				          });
																				    })
		                                     .appendTo('.blog-buttons-container');
          
      $('.blog-buttons-container').append(' ');
      <?php endif?>
      
      $(document.createElement('button')).text('<?php echo __('Preview')?>')
																	       .prepend($(document.createElement('span')).attr('class', 'icon-preview-button'))
																	       .click(function(){
																	             $('#blog-form').attr('action', '<?php echo url_for(array('sf_route' => 'plugin_blog_preview', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug()))?>')
																	                            .attr('target', '_blank')
																	                            .submit();
																	             })
																	       .appendTo('.blog-buttons-container');

      $('.blog-buttons-container').append(' ');

      $(document.createElement('button')).text('<?php echo __('Close')?>')
																	       .prepend($(document.createElement('span')).attr('class', 'icon-cancel-button'))
																	       .click(function(){
																	              location.href = '<?php echo $post->getIsPublic()? url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug(), 'id' => $post->getId(), 'slug' => $post->getSlug())):
																	                                                  url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug())) ?>';
																	             })
																	       .appendTo('.blog-buttons-container');
          
		}	
    
  }

</script> 
