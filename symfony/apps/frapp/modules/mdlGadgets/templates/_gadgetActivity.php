<?php use_helper('Date')?>

<button class="gadget-button peekaboo-child" onclick="location.href='<?php echo $editUrl ?>'"><span class="icon-button-edit"></span></button>

<?php if (isset($parameters['gadget_name']) && $parameters['gadget_name'] != ''):?>
<div class="gadget-hd">
  <h2><?php echo $parameters['gadget_name']?></h2>
</div>
<?php endif?>

<div class="gadget-bd">        
	<?php foreach ($sf_data->getRaw('activities') as $activity):?>
    <div class="pb-2 mb-2 separator-b">
      <?php echo HerodotActivityOther($activity['type'], $activity);?>
    </div>
    <?php endforeach?>
    <div class="clear"></div>
</div><!-- gadget-bd end -->

