<?php if (isset($parameters['gadget_name']) && $parameters['gadget_name'] != ''):?>
<div class="gadget-hd">
  <h2><?php echo $parameters['gadget_name']?></h2>
</div>
<?php endif?>

<div class="gadget-bd">        
	<?php echo $sf_data->getRaw('content')?>
</div><!-- gadget-bd end -->

<div class="gadget-ft"></div>