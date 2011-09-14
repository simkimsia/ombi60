<div class="merchants form">
<?php echo $form->create('Merchant');?>
	<fieldset>
 		<legend><?php echo __('Edit Merchant');?></legend>
	<?php
		echo $form->input('full_name');
		echo $form->input('name_to_call');
		echo $form->input('email');
		echo $form->input('password');
		
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
