<div class="cell-hd">
<h2><?php echo __('Add new album')?></h2>
</div>
<!--  cell-head end -->

<div class="cell-bd">

<form method="post" enctype="multipart/form-data"
	action="<?php echo url_for(array('sf_route' => 'plugin_photos_photo_upload', 'microsite_slug' => $thisMicrosite->getSlug()))?>">
<?php echo $form->render()?> <input type="submit" /></form>



</div>
<!-- cell-bd end -->




