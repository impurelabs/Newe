<h1><?php echo __('Login')?></h1>


<form method="post" action="<?php echo url_for('@login');?>">
	<?php echo $form->renderHiddenFields()?>
	<?php echo $form->renderGlobalErrors();?>

	<?php echo $form['email']->render();?><br />
	<?php echo $form['email']->renderError();?>

	<div></div>
	<?php echo $form['password']->render();?><br />
	<?php echo $form['password']->renderError();?>

	<div></div>
	<?php echo $form['remember']->render();?> <?php echo $form['remember']->renderLabel('Remember me');?>


	<div></div>
	<button type="submit"><span class="icon-save"></span><?php echo __('Sign in');?>
	</button>

	<a href="<?php echo url_for('@forgotPassword')?>" class="ml-2"><?php echo __('forgot password')?></a>
</form>

