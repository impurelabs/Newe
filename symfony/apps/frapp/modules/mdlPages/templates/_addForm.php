<form id="page-form" method="post" action="<?php echo url_for(array('sf_route' => 'plugin_pages_add', 'microsite_slug' => $thisMicrosite->getSlug(), 'plugin_slug' => $plugin->getSlug()));?>">
<?php echo $form->renderHiddenFields()?> <?php echo $form->renderGlobalErrors();?>

<?php echo $form['name']->renderLabel()?> <br />
<?php echo $form['name']->render(array('class' => 'span-18'))?>
<?php echo $form['name']->renderError()?>

<div class="mt-2"></div>

<?php echo $form['content']->renderLabel()?> <br />
<?php echo $form['content']->render(array('class' => 'mceEditor'))?> <?php echo $form['content']->renderError()?>

<div class="mt-2"></div>

</form>

<?php include_partial('default/wysiwygEditor', array('width' => 688, 'height' => 500))?>
