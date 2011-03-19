<?php if (stPeterAcl::getInstance()->isAllowed($sf_user->getRoleId(), $plugin->getResourceId(), stPeterAcl::PERM_UPDATE)):?>
<button type="button" id="page-add-button"
	onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_pages_add', 'microsite_slug' => $thisMicrosite->getSlug(), 'sf_subject' => $sf_data->getRaw('plugin')));?>'"
	style="width: 140px; position: absolute; top: 10px;"><span
	class="icon-add"></span><?php echo __('Add page')?></button>
<?php endif?>

<?php if ($pages->count() > 0):?>
<ul class="submenu" id="plugin_pages">
<?php foreach ($sf_data->getRaw('pages') as $page):?>
	<li id="page-<?php echo $page->getId()?>"
	<?php if(isset($currentPage) and $currentPage->getId() == $page->getId()) echo 'class="selected-page"';?>
		onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_pages_page', 'sf_subject' => $page, 'microsite_slug' => $thisMicrosite->getSlug()))?>'">
		<?php if (stPeterAcl::getInstance()->isAllowed($sf_user->getRoleId(), $plugin->getResourceId(), stPeterAcl::PERM_UPDATE)):?>
	<span id="page-sorthandle-<?php echo $page->getId()?>"
		class="page-sorthandle right iconbutton icon-sort-link"
		style="display: none; width: 25px; height: 18px; padding: 0; position: absolute; right: 0px"></span>
		<?php endif?> <a
		href="<?php echo url_for(array('sf_route' => 'plugin_pages_page', 'sf_subject' => $page, 'microsite_slug' => $thisMicrosite->getSlug()))?>"><?php echo $page->getName()?></a>
	</li>
	<?php endforeach;?>
</ul>
	<?php endif;?>

	<?php if (stPeterAcl::getInstance()->isAllowed($sf_user->getRoleId(), $plugin->getResourceId(), stPeterAcl::PERM_UPDATE)):?>
<script type="text/javascript">
	  $(document).ready(function(){
		  $('#plugin_pages').sortable({
			  placeholder: 'placeholder',
			  handle: 'span.page-sorthandle',
			  axis: 'y',
			  forcePlaceholderSize: true,
			  update: function(event, ui) {
			         
			         pageId = $(ui.item).attr('id').substr(5);
			         sortedPages = $('#plugin_pages').sortable('toArray');
	
			         for (var i in sortedPages){
			             if ($(ui.item).attr('id') == sortedPages[i]){
			            	 pagePosition = parseInt(i) + 1;
			             } 
			         }
	
			         $.post( '<?php echo url_for(array('sf_route' => 'plugin_pages_sort', 'microsite_slug' => $thisMicrosite->getSlug(), 'sf_subject' => $sf_data->getRaw('plugin')))?>', { page_id: pageId, page_position: pagePosition}, function(data){});
			  }
			});
	
			$('#plugin_pages > li').mouseover(function(){
				  $('#page-sorthandle-' + $(this).attr('id').substr(5)).show();
		  });
			$('#plugin_pages > li').mouseout(function(){
		        $('#plugin_pages > li > span').hide();
		    });
	
		});
	</script>
	<?php endif?>