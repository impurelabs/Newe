<div class="cell-hd">
<h2><?php echo $plugin->getName()?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">
	<?php if (stPeterAcl::getInstance()->isAllowed($sf_user->getRoleId(), $plugin->getResourceId(), stPeterAcl::PERM_UPDATE)):?>
    <div class="admin-cell">
      <button onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_pages_add', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()));?>'" type="button" id="page-add-button"><span class="icon-button-add mr-1"></span><?php echo __('Add new page')?></button>
    </div><!-- admin-cell end -->
     <?php endif?>
 
	<div class="cell-bd-content">
	<?php echo __('No pages added. <br />Click the "Add page" button to add a page!')?>
    </div><!-- cell-bd-content -->

</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>