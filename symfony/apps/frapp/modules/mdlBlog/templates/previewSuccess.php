<?php use_helper('Date')?>

<div class="cell-hd">
 <h2><?php echo $plugin->getName()?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd cell-minheight">
<div class="admin-cell mb-2 align-center"><?php echo __('This is just a preview. To go back close this tab / window')?></div>
<div class="cell-bd-content">

<div id="blog-post-details">
	<h3 class="mb-4"><?php echo $post['name']?></h3>
	<?php $post = $sf_data->getRaw('post'); echo $post['content']?>
</div>

<div class="clear"></div>
</div><!-- cell-bd-content -->
</div>
<!-- cell-bd end -->
<div class="cell-ft"></div>