<?php use_helper('Date')?>

<button class="gadget-button peekaboo-child" onclick="location.href='<?php echo $editUrl ?>'"><span class="icon-button-edit"></span></button>

<?php if (isset($parameters['gadget_name']) && $parameters['gadget_name'] != ''):?>
<div class="gadget-hd">
  <h2><?php echo $parameters['gadget_name']?></h2>
</div>
<?php endif?>

<div class="gadget-bd"> 
	<?php foreach ($posts as $post):?>
    <a class="strong" href="<?php echo url_for(array('sf_route' => 'plugin_blog_view', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug'=> $post['plugin_slug'], 'id' => $post['post_id'], 'slug' => $post['post_slug'])) ?>" class="important-link"> <?php echo $post['post_name'];?></a>
    <div class="pb-2 mb-2 separator-b">
    <div class="timestampable"><?php echo format_date($post['post_published_at'], 'D')?></div>
    </div>
        <?php endforeach?>
    <div class="clear"></div>
</div>

