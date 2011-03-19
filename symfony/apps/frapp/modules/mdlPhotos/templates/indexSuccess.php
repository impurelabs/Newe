
<div class="cell-hd">
  <h2><?php echo $plugin->getName()?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">
  <?php if ($pluginUpdatePermission):?>
  <div class="admin-cell">
    <button onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_photos_album_add',  
                                                              'microsite_slug' => $thisMicrosite->getSlug(), 
                                                              'plugin_slug' => $plugin->getSlug()));?>'" type="button" ><span class="icon-button-add mr-1"></span><?php echo __('Add Album')?></button>
  </div>
  <!-- admin-cell end -->
  <?php endif;?>
  <div class="cell-bd-content">
    <ul id="album-list" class="clearfix">
      <?php foreach ($albums as $album):?>
      <li><a class="album-thumb plugin-photos-thumb"
		href="<?php echo url_for(array('sf_route' => 'plugin_photos_photo_list', 'album_id' => $album->getId(), 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()))?>"> <img src="<?php echo $album->getCover()?>" /> </a> <a
		class="important-link"
		href="<?php echo url_for(array('sf_route' => 'plugin_photos_photo_list', 'album_id' => $album->getId(), 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()))?>"><?php echo $album->getName()?></a> </li>
      <?php endforeach;?>
    </ul>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>
<style type="text/css">
#album-list li {
	float: left;
	margin: 0px 0px 20px 50px;
	width: 140px;
	padding: 0 15px;
	text-align: center;
}

.album-thumb {
	display: table-cell;
	vertical-align: middle;
	width: 130px;
	height: 130px;
	margin-left: 30px
}
}
</style>
