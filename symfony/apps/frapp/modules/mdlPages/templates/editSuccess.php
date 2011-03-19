<?php use_javascript('jquery.form.js')?>

<div class="cell-hd">
  <h2> <?php echo __('Edit page "%1%"', array('%1%' => $form->getObject()->getName()))?></h2>
</div>
<!--  cell-head end -->

<div id="page-content" class="cell-bd">
	<div class="separator-b pl-2"><!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small" href="<?php echo url_for(array('sf_route' => 'plugin_pages_page', 'plugin_slug' => $form->getObject()->getPlugin()->getSlug(), 'slug' => $form->getObject()->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()))?>">
		<?php echo $form->getObject()->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo __('Add new page')?></span> </div>
  <!-- breadcrumbs end -->
  

  <div class="cell-bd-content">
    <div class="page-buttons-container mb-3 align-right">
      <button class="page-save-button mr-2" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Save changes')?></button>
      <a
	href="<?php echo url_for(array('sf_route' => 'plugin_pages_page', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $form->getObject()->getPlugin()->getSlug(), 'slug' => $form->getObject()->getSlug()));?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Close')?></a></div>
    <div id="page-form-container">
      <form id="page-form" method="post"
	action="<?php echo url_for(array('sf_route' => 'plugin_pages_edit', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $form->getObject()->getPlugin()->getSlug(), 'slug' => $form->getObject()->getSlug()));?>">
        <?php echo $form->renderHiddenFields()?> <?php echo $form->renderGlobalErrors();?> <?php echo $form['name']->renderLabel()?> <br />
        <?php echo $form['name']->render(array('class' => 'span-18'))?> <?php echo $form['name']->renderError()?>
        <div class="mb-4"></div>
        <?php echo $form['content']->renderLabel()?> <br />
        <?php echo $form['content']->render(array('class' => 'mceEditor'))?> <?php echo $form['content']->renderError()?>
        <div class="mb-4"></div>
        <label for="plugin_pages_page_position"><?php echo __('Position in menu')?></label>
        <br />
        <select name="position">
          <?php foreach ($positions as $position):?>
          <option value="<?php echo $position?>" <?php echo $position == $form->getObject()->getPosition() ? 'selected="selected"' : ''?>><?php echo $position?></option>
          <?php endforeach?>
        </select>
      </form>
    </div>
    <!-- page-form-container-end -->
    
    <div class="page-buttons-container mt-3 align-right">
      <button class="page-save-button mr-2" type="submit"><span class="icon-button-save mr-1"></span><?php echo __('Save')?></button>
      <a href="<?php echo url_for(array('sf_route' => 'plugin_pages_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $form->getObject()->getPlugin()->getSlug()));?>"><span class="icon-button-cancel mr-1"></span><?php echo __('Close')?></a></div>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>
<?php include_partial('default/wysiwygEditor', array('width' => 688, 'height' => 500))?>
<script type="text/javascript">

  $(document).ready(function(){

	  $('.page-save-button').click(function(){
		  $('#page-form').submit();
	  });
	    
      $("#page-form").ajaxForm({
        beforeSubmit: beforePageEdit,
        success: pageEditSuccess,
        beforeSerialize: function(){
          var editor = tinyMCE.get('plugin_pages_page_content');
          $('#plugin_pages_page_content').val(editor.getContent());  
        },
        type: "post"
    });
    
  });

  function beforePageEdit(){
      $('.page-buttons-container').html('');
      $('.page-buttons-container').append('<?php echo image_tag('indicator.gif')?>');
      
      var editor = tinyMCE.get('plugin_pages_page_content');
      editor.setProgressState(1);
  }

  function pageEditSuccess()
  {
	  $('.page-buttons-container').children().remove;
    $('.page-buttons-container').html('');
	  
	  $(document.createElement('button')).attr('type', 'button')
									      .attr('class', 'mr-2')
									      .html('<span class="icon-button-save mr-1"></span><?php echo __('Save changes')?> ')
									      .click(function(){ $('#page-form').submit() })
									      .appendTo('.page-buttons-container');

      
	  $(document.createElement('a'))
      .attr('href', '<?php echo url_for(array('sf_route' => 'plugin_pages_page', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $form->getObject()->getPlugin()->getSlug(), 'slug' => $form->getObject()->getSlug()));?>')
      .html('<span class="icon-button-cancel mr-1"></span><?php echo __('Close')?>')
      .appendTo('.page-buttons-container');
      
	  var editor = tinyMCE.get('plugin_pages_page_content');
    editor.setProgressState(0);

    emoFlash('Page saved successfully.');
  }

</script> 
