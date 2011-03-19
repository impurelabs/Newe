<?php use_helper('Date')?>

<div class="cell-hd">
  <h2><?php echo $plugin->getName()?></h2>
</div>
<!--cell-head end -->


<div class="cell-bd cell-minheight">
	<?php if ($pluginUpdatePermission):?>
	<div class="admin-cell">
		<?php if (isset($posts['drafts'])) { include_partial('pluginBlog/draftsMenu', array('drafts' => $posts['drafts'], 'plugin' => $plugin)); }?>
  		<button onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_blog_add', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()));?>'" type="button"><span class="icon-button-add mr-1"></span><?php echo __('Add Post')?></button>
	</div><!-- admin-cell -->
    <?php endif ?>
    
  <div class="cell-bd-content">
    <?php if (isset($posts['published'])):?>
    <ul id="blogpost-list">
      <?php foreach ($posts['published'] as $post):?>
      <li id="blog-post-<?php echo $post->getId();?>" class="peekaboo-parent separator-b mb-2"> 
        <h4 class="mb-2"> <a href="<?php echo url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(),'plugin_slug' => $plugin->getSlug(),'slug' => $post->getSlug(), 'id' => $post->getId()))?>"><?php echo $post->getName()?></a></h4>

        <p class="timestampable"><?php echo format_date($post->getPublishedAt(), 'D')?></p>
      </li>
      <?php endforeach;?>
    </ul>
    <?php endif?>
    <div class="clear"></div>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>
