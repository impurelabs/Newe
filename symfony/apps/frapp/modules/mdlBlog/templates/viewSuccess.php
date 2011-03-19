<?php use_helper('Date')?>

<div class="cell-hd">

  <h2><?php echo $post->getPlugin()->getName()?></h2>
</div>
<!--  cell-head end -->


<div class="cell-bd cell-minheight">
	<?php if ($updatePermission):?>
	<div class="admin-cell">
      <button onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_blog_edit', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug'    => $post->getPlugin()->getSlug(),'id' => $post->getId()));?>'"type="button"><span class="icon-button-edit mr-1"></span><?php echo __('Edit Post')?></button>
      <button id="blog-delete-button" type="button"><span class="icon-button-delete mr-1"></span><?php echo __('Delete Post')?></button>
    </div><!-- admin-cell end -->
    <?php endif ;?>

	<div class="separator-b pl-2"> <!-- breadcrumbs start --> 
    <span class="small quiet"><?php echo __('You are here')?>: </span> 
    <a class="small strong" href="<?php echo url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug()))?>">
        <?php echo $post->getPlugin()->getName()?>
    </a> 
    <span class="small quiet">&raquo;</span> 
    <span class="small"><?php echo $post->getName()?></span> </div>
  <!-- breadcrumbs end -->
  
  <div class="cell-bd-content">
    <div id="blog-post-details">
      <h1><?php echo $post->getName()?></h1>
      <?php echo $sf_data->getRaw('post')->getContent()?>
      <div class="p-2">
        <p class="timestampable"><?php echo format_date($post->getPublishedAt(), 'D')?></p>
      </div>
    </div>
    <div class="clear mb-3"></div>
    <div style="width: 580px; margin: 0 auto">
<?php include_component('emoComment', 'formAndList', array(
	'modelClass' => 'pluginBlogPost', 
	'modelId' => $post->getId(),
	'deleteUrl' => url_for(array(
		'sf_route' => 'comment_delete', 
		'action' => 'pluginBlogPost')
	),
	'permSocial' => $permSocial,
	'permSocialTrusted' => $permSocialTrusted,
	'detailsForHerodot' => urlencode(serialize(array(
		'post_name'    => $post->getName(),
		'post_url'     => url_for(array(
			'sf_route' => 'plugin_blog_view', 
			'microsite_slug' => $thisMicrosite->getSlug(), 
			'plugin_slug'    => $post->getPlugin()->getSlug(),
			'id'             => $post->getId(),
			'slug'           => $post->getSlug()
		)),
		'owner_id'     => $thisMicrosite->getMemberId(),
		'microsite_id' => $thisMicrosite->getId()
)))))?>
    </div>
  </div>
  <!-- cell-bd-content --> 
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>

<div id="popup-delete" style="display: none">
	<div class="mb-3"><?php echo __('Are you sure you want to delete this Blog Post?')?></div>
    <button type="button" class="button-yes mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Yes');?></button>
    <button type="button" class="button-no"><span class="icon-button-cancel mr-1"></span><?php echo __('No');?></button>
</div>


<script type="text/javascript">
$(document).ready(function(){
	//Photo Delete functionality
	$('#blog-delete-button').click(function(){
		
		$('#popup-delete').dialog({
			title: '<?php echo __('Delete Blog Post?');?>',
			show: 'clip',
			hide: 'clip',
			width: 350,
			height: 170,
			modal: true,
			resizable: false,
			open: function(){
				/* Create the yes, cancel events*/
				$('#popup-delete').find('.button-yes').unbind().click(function(){
					$('#popup-delete').dialog('close');
					
					//***** THE ACTUAL DELETING START *****//
					deleteBlogPost();
					//***** THE ACTUAL DELETING END *****//
				});
				
				$('#popup-delete').children('.button-no').unbind().click(function(){
					$('#popup-delete').dialog('close');
				})
			}
		});
	});

});

function deleteBlogPost()
{
	$.post( '<?php echo url_for(array('sf_route' => 'plugin_blog_delete', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug'    => $post->getPlugin()->getSlug(), 'id' => $post->getId()));?>', { }, function(data){
		$('#blog-post-details').fadeOut('normal', function(){
			location.href='<?php echo url_for(array('sf_route' => 'plugin_blog_index', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $post->getPlugin()->getSlug()))?>';
		});
	})
}

</script> 
