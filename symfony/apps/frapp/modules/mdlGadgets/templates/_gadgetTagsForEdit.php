<?php if (isset($parameters['gadget_name']) && $parameters['gadget_name'] != ''):?>
<div class="gadget-hd">
  <h2><?php echo $parameters['gadget_name']?></h2>
</div>
<?php endif ;?>

<div class="gadget-bd">        
	<?php foreach ($tags as $tag):?>
	  <?php if($tag['state'] == '1'):?>
      <span class="resptag"><?php echo $tag['name']; ?></span>
      <?php endif?>
    <?php endforeach;?>
</div><!-- gadget-bd end -->

<div class="gadget-ft"></div>