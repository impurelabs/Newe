<div id="blog-drafts" class="admin-dropdown h5-container">
  <a href="javascript: void(0)" class="h5"><?php echo __('My Drafts')?><span class="h5icon-arrowdown right"></span></a>
  
<ul id="blog-drafts-list">
<?php foreach ($drafts as $draft):?>
	<li>
	<li><a href="<?php echo url_for(array('sf_route'       => 'plugin_blog_edit', 
                                        'microsite_slug' => $thisMicrosite->getSlug(),
                                        'plugin_slug'    => $plugin->getSlug(),
                                        'id'             => $draft->getId()))?>">
		<?php echo $draft->getName()?>
	</a></li>
	<?php endforeach;?>

</ul>
</div> <!-- blog-drafts end -->
<style type="text/css">
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $('#blog-drafts').click(function(event){                
      if ($('#blog-drafts-list').is(':hidden')){         
        $('#blog-drafts-list').slideDown('fast');
      } else {
        $('#blog-drafts-list').slideUp('fast');
      } 

      event.stopPropagation();
    });

    $(document).click(function() {
      $('#blog-drafts-list').slideUp('fast');
               
    });
  });
</script>