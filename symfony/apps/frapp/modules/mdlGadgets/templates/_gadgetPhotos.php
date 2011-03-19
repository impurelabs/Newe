<button class="gadget-button peekaboo-child" onclick="location.href='<?php echo $editUrl ?>'"><span class="icon-button-edit"></span></button>

<?php if (isset($parameters['gadget_name']) && $parameters['gadget_name'] != ''):?>
<div class="gadget-hd">
  <h2><?php echo $parameters['gadget_name']?></h2>
</div>
<?php endif?>

<div class="gadget-bd">        
	<?php foreach ($photos as $photo):?>
    <div class="plugin-photos-photo-container ml-2 mb-2 left">
      <a	href="<?php echo url_for(array('sf_route'       => 'plugin_photos_photo_view',
                                           'microsite_slug' => $thisMicrosite->getSlug(),
                                                                         'album_id'       => $photo['album_id'],
                                                                         'plugin_slug'    => $photo['plugin_slug'],
                                                                         'photo_id'       => $photo['photo_id'])) ?>">
        <img src="<?php echo emoPluginPhotosPhotoThumb($photo['photo_filename'])?>" class="plugin-photos-thumb" />
      </a>
    </div>
    <?php endforeach?>
    <div class="clear"></div>
</div><!-- gadget-bd end -->