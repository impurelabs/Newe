<div class="cell-hd">
  <h2><?php echo __('Add New Post')?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">
	<div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()))?>">
        <?php echo $plugin->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo __('Add New Post')?></span> </div>
  <!-- breadcrumbs end -->
  
  <div class="cell-bd-content">
    <div class="blog-buttons-container align-right mb-3">
      <button class="blog-draft-button" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Save Draft')?></button>
      <button class="blog-publish-button" type="button"><span class="icon-button-add mr-1"></span><?php echo __('Publish')?></button>
      <a href="<?php echo url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()))?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?></a></div>
    <div id="blog-form-container">
      <div id="blog-form-target"
	style="position: absolute; top: 5px; width: 550px; text-align: center; display: none"></div>
      <form id="blog-form" method="post"
	action="<?php echo url_for(array('sf_route' => 'plugin_blog_add', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()))?>">
        <?php echo $form->renderHiddenFields()?> 
		<?php echo $form->renderGlobalErrors();?> 
        
        
		<?php echo $form['name']->renderLabel()?> <br />
        <?php echo $form['name']->render(array('class' => 'span-18'))?> <?php echo $form['name']->renderError()?>
        
        <div class="mb-3"></div>
        
        <?php echo $form['content']->renderLabel()?> <br />
        <?php echo $form['content']->render(array('class' => 'mceEditor'))?> <?php echo $form['content']->renderError()?>
      </form>
    </div>
    <!-- page-form-container-end -->
    
    <div class="blog-buttons-container align-right mt-3">
      <button class="blog-draft-button" type="submit"><span class="icon-button-save mr-1"></span><?php echo __('Save')?></button>
      <button class="blog-publish-button" type="button"><span class="icon-button-add mr-1"></span><?php echo __('Publish')?></button>
      <a href="<?php echo url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()))?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Cancel')?></a></div>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>
<?php include_partial('default/wysiwygEditor', array('width' => 688, 'height' => 500))?>
<script type="text/javascript">


  $(document).ready(function(){

    $('.blog-draft-button').click(function(){
  	    $('#plugin_blog_post_is_public').val('0');
        $('#blog-form').submit();
    });

    $('.blog-publish-button').click(function(){
        $('#plugin_blog_post_is_public').val('1');
        $('#blog-form').submit();
    });
      
  });
</script> 
